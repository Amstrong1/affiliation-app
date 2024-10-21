<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subscription;
use Illuminate\Support\Carbon;
use App\Models\SubscriptionPlan;
use App\Models\AffiliateCommission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CommissionEarnedNotification;

class SubscriptionController extends Controller
{

    public function handleSubscriptionRenewal(User $user, $amount)
    {   

        // Vérifier si l'utilisateur a un parrain
        if ($user->referred_by) {
            $referrer = User::find($user->referred_by);
            $subscription = Subscription::where('user_id', $user->id)->first();

            if ($subscription->renewal_count == 1) {
                $referrer->balance += 100;
            }
            
            // // Vérifier le nombre de renouvellements pour ne pas dépasser 4 paiements de commission
            if ($subscription->renewal_count <= 4) {
                $commission = $amount * 0.10; // 10% du montant de l'abonnement

                // Créer une nouvelle entrée de commission pour le parrain
                AffiliateCommission::create([
                    'user_id' => $referrer->id,
                    'referred_user_id' => $user->id,
                    'commission_amount' => $commission,
                    'renewal_count' => $subscription->renewal_count,
                ]);

                // Créditer le compte du parrain sur la plateforme
                $referrer->balance += $commission;
                $referrer->save();

                // Notification::send($referrer, new CommissionEarnedNotification($commission));
            }
        }
    }

    public function purchaseItem($plan_id)
    {
        $user = User::find(Auth::user()->id);
        
        if ($user->subscription == null || $user->subscription->renewal_count == 0) {
            $user->balance += 1000;
            $user->save();
        }  

        // Récupérer le plan d'abonnement choisi
        $plan = SubscriptionPlan::find($plan_id);

        if (!$plan) {
            return response()->json(['error' => 'Plan d\'abonnement non valide.'], 400);
        }

        // Vérifier si l'utilisateur a assez de crédit pour l'abonnement
        if ($user->balance >= $plan->price) {
            // Calculer la date de fin d'abonnement
            $startDate = Carbon::now();
            $endDate = $startDate->copy()->addDays($plan->duration_in_days);

            // Créer ou mettre à jour l'abonnement de l'utilisateur
            $subscribed = Subscription::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'subscription_plan_id' => $plan->id,
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'is_active' => true,
                    'renewal_date' => $startDate,
                ]
            );

            // Sinon, incrémenter la valeur actuelle de renewal_count
            $subscribed->renewal_count += 1;

            // Sauvegarder les modifications
            $subscribed->save();


            if ($subscribed) {
                // Déduire le prix de l'abonnement du solde de l'utilisateur
                $user->balance -= $plan->price;
                $user->save();
                $this->handleSubscriptionRenewal($user, $plan->price);
            }

            return response()->json(['success' => 'Abonnement activé avec succès !', 'plan' => $plan->name]);
        } else {
            return response()->json(['error' => 'Solde insuffisant pour cet abonnement.'], 400);
        }
    }

    public function checkSubscriptionStatus(User $user)
    {
        $subscription = Subscription::where('user_id', $user->id)->where('is_active', true)->first();

        if ($subscription && Carbon::now()->lessThanOrEqualTo($subscription->end_date)) {
            return true; // L'utilisateur est abonné
        }

        return false; // L'utilisateur n'est plus abonné ou n'a jamais été abonné
    }
}
