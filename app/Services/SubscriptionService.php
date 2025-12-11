<?php

namespace App\Services;

use App\Models\Subscription;
use Illuminate\Support\Carbon;

class SubscriptionService
{
    /**
     * Activate or extend a subscription.
     *
     * @param int $userId
     * @param int $planId
     * @param int $days int number of days to add
     * @return Subscription
     */
    public static function activateForUser(int $userId, int $planId, int $days = 30): Subscription
    {
        $now = now();

        // find latest active or last subscription for this user/plan
        $latest = Subscription::where('user_id', $userId)
                              ->where('plan_id', $planId)
                              ->orderByDesc('expires_at')
                              ->first();

        if ($latest && $latest->expires_at && $latest->expires_at->greaterThan($now)) {
            // extend from existing expiry
            $startsAt = $latest->starts_at ?? $now;
            $expiresAt = $latest->expires_at->copy()->addDays($days);
        } else {
            // new subscription starting now
            $startsAt = $now;
            $expiresAt = $now->copy()->addDays($days);
        }

        // mark previous subscriptions as expired if needed
        Subscription::where('user_id', $userId)
            ->where('plan_id', $planId)
            ->where('status', 'active')
            ->update(['status' => 'expired']);

        return Subscription::create([
            'user_id' => $userId,
            'plan_id' => $planId,
            'starts_at' => $startsAt,
            'expires_at' => $expiresAt,
            'status' => 'active',
        ]);
    }
}
