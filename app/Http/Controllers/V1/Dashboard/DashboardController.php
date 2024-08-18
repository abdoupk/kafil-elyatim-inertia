<?php

namespace App\Http\Controllers\V1\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Finance;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Tenant/dashboard/TheDashboardPage', [
            'reports' => fn () => generateGlobalDashBoardReportStatistics(),
            'financialReports' => fn () => generateFinancialReport(),
            'radar' => fn () => generateTest(),
            'recentActivities' => fn () => $this->getRecentActivities(),
            'recentTransactions' => fn () => $this->getRecentTransactions(),
            'comingEvents' => fn () => $this->getComingEvents(),
            'recentFamilies' => fn () => $this->getRecentFamilies(),
            'recentNeeds' => fn () => $this->getRecentNeeds(),
        ]);
    }

    private function getRecentActivities()
    {
        return auth()->user()->notifications->take(5)->map(function ($notification) {
            return [
                'id' => $notification->id,
                'user' => [
                    'id' => $notification->data['user']['id'],
                    'name' => $notification->data['user']['name'],
                    'gender' => $notification->data['user']['gender'],
                ],
                'formatted_date' => $notification->created_at->translatedFormat('H:i A'),
                'date' => $notification->created_at,
                'message' => trans_choice('notifications.branch.created', $notification->data['user']['gender'] === 'male' ? 0 : 1, $notification->data['data']),
            ];
        })->toArray();
    }

    private function getRecentTransactions(): array
    {
        return Finance::with('receiver:id,first_name,last_name,gender')->select(['id', 'amount', 'received_by', 'date'])->latest()->take(5)->get()->map(function (Finance $finance) {
            return [
                'id' => $finance->id,
                'amount' => $finance->amount,
                'receiver' => [
                    'id' => $finance->receiver->id,
                    'name' => $finance->receiver->getName(),
                    'gender' => $finance->receiver->gender,
                ],
                'date' => $finance->date->translatedFormat('j F Y'),
            ];
        })->toArray();
    }

    private function getComingEvents(): array
    {
        return [];
    }

    private function getRecentFamilies(): array
    {
        return [];
    }

    private function getRecentNeeds(): array
    {
        return [];
    }
}
