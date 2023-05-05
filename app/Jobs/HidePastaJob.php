<?php

namespace App\Jobs;

use App\Models\Pasta;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class HidePastaJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private int $id;

    /**
     * Create a new job instance.
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Осуществляет мягкое удаление пасты
     */
    public function handle(): void
    {
        Pasta::destroy($this->id);
    }
}
