<?php

namespace App\Jobs\V1;

use App\Models\Branch;
use App\Models\User;
use App\Notifications\CreateBranchNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Notification;

class BranchCreatedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Branch $branch) {}

    public function handle(): void
    {
        $users = User::all();

        Notification::send($users, new CreateBranchNotification($this->branch));
    }
}
