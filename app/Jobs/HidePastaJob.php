<?php

namespace App\Jobs;

use App\Repositories\Interfaces\PastaRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class HidePastaJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $id;

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
    public function handle(PastaRepositoryInterface $pastaRepository): void
    {
        $pastaRepository->softDeletePasta($this->id);
    }
}
