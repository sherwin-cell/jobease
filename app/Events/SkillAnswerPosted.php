<?php

namespace App\Events;

use App\Models\SkillAnswer;
use App\Models\SkillQuestion;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SkillAnswerPosted implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public SkillQuestion $skillQuestion,
        public SkillAnswer $answer,
    ) {
        // Ensure the user relationship is available for the broadcast payload
        $this->answer->loadMissing('user');
    }

    public function broadcastOn(): array
    {
        return [new PrivateChannel('skill-question.' . $this->skillQuestion->id)];
    }

    public function broadcastAs(): string
    {
        return 'skill.answer.posted';
    }

    public function broadcastWith(): array
    {
        return [
            'skill_question_id' => $this->skillQuestion->id,
            'answer' => [
                'id' => $this->answer->id,
                'body' => $this->answer->body,
                'user' => [
                    'id' => $this->answer->user?->id,
                    'name' => $this->answer->user?->name ?? 'Unknown',
                ],
                'created_at' => optional($this->answer->created_at)->toISOString(),
                'created_at_human' => optional($this->answer->created_at)->diffForHumans(),
            ],
        ];
    }
}

