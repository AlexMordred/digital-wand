<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Video;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\UnreviewedVideos;

class EmailUnreviewedVideos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'videos:email:unreviewed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email a list of videos that has been unreviewed for over 3 days to the admin.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $videos = Video::where('reviewed', false)
            ->where('created_at', '<', Carbon::now()->subDays(3))
            ->get();

        $admin = User::where('role', User::ROLE_ADMIN)->first();

        Mail::to($admin->email)
            ->send(new UnreviewedVideos($videos));
    }
}
