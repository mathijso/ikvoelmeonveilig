<?php

namespace App\Livewire\Feedback;

use App\Models\Feedback;
use App\Models\FeedbackVote;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
class Index extends Component
{
    use WithPagination;

    #[Validate('required|string|min:5|max:255')]
    public string $title = '';

    #[Validate('required|string|min:10|max:2000')]
    public string $description = '';

    #[Validate('required|in:feature,improvement,bug,other')]
    public string $category = 'feature';

    public bool $is_anonymous = true;
    public bool $showForm = false;
    public string $sortBy = 'score'; // score, recent
    public string $filterCategory = '';

    public function mount()
    {
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->title = '';
        $this->description = '';
        $this->category = 'feature';
        $this->is_anonymous = true;
        $this->showForm = false;
    }

    public function showAddForm()
    {
        $this->resetForm();
        $this->showForm = true;
    }

    public function cancel()
    {
        $this->resetForm();
    }

    public function submitFeedback()
    {
        $this->validate();

        try {
            Feedback::create([
                'user_id' => Auth::id(),
                'title' => $this->title,
                'description' => $this->description,
                'category' => $this->category,
                'is_anonymous' => $this->is_anonymous,
            ]);

            $this->dispatch('feedback-submitted', message: 'Feedback succesvol ingediend! Bedankt voor je bijdrage.');
            $this->resetForm();
        } catch (\Exception $e) {
            $this->addError('general', 'Er is een fout opgetreden bij het indienen van je feedback. Probeer het opnieuw.');
        }
    }

    public function vote($feedbackId, $voteType)
    {
        if (!Auth::check()) {
            $this->addError('general', 'Je moet ingelogd zijn om te kunnen stemmen.');
            return;
        }

        try {
            $feedback = Feedback::findOrFail($feedbackId);
            
            // Check if user already voted
            $existingVote = FeedbackVote::where('feedback_id', $feedbackId)
                ->where('user_id', Auth::id())
                ->first();

            if ($existingVote) {
                if ($existingVote->vote_type === $voteType) {
                    // Remove vote if clicking the same button
                    $existingVote->delete();
                    $this->updateFeedbackCounts($feedback, $voteType, -1);
                } else {
                    // Change vote
                    $existingVote->update(['vote_type' => $voteType]);
                    $this->updateFeedbackCounts($feedback, $existingVote->vote_type, -1);
                    $this->updateFeedbackCounts($feedback, $voteType, 1);
                }
            } else {
                // Create new vote
                FeedbackVote::create([
                    'feedback_id' => $feedbackId,
                    'user_id' => Auth::id(),
                    'vote_type' => $voteType,
                ]);
                $this->updateFeedbackCounts($feedback, $voteType, 1);
            }

            $this->dispatch('vote-updated', message: 'Stem bijgewerkt!');
        } catch (\Exception $e) {
            $this->addError('general', 'Er is een fout opgetreden bij het stemmen. Probeer het opnieuw.');
        }
    }

    private function updateFeedbackCounts($feedback, $voteType, $change)
    {
        if ($voteType === 'upvote') {
            $feedback->increment('upvotes', $change);
        } else {
            $feedback->increment('downvotes', $change);
        }
    }

    public function setSortBy($sort)
    {
        $this->sortBy = $sort;
        $this->resetPage();
    }

    public function setFilterCategory($category)
    {
        $this->filterCategory = $category;
        $this->resetPage();
    }

    public function render()
    {
        $query = Feedback::with(['user', 'votes']);

        // Apply category filter
        if (!empty($this->filterCategory)) {
            $query->byCategory($this->filterCategory);
        }

        // Apply sorting
        if ($this->sortBy === 'score') {
            $query->orderByScore();
        } else {
            $query->orderByRecent();
        }

        $feedback = $query->paginate(10);

        // Add user vote information to each feedback item
        if (Auth::check()) {
            $feedback->getCollection()->transform(function ($item) {
                $item->user_vote = $item->getUserVote(Auth::id());
                return $item;
            });
        }

        return view('livewire.feedback.index', [
            'feedback' => $feedback,
            'categories' => [
                'feature' => 'Nieuwe Feature',
                'improvement' => 'Verbetering',
                'bug' => 'Bug Report',
                'other' => 'Overig'
            ]
        ]);
    }
}
