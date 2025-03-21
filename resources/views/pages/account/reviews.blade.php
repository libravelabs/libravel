@props([
    'reviewUser' => null,
    'title' => __('review.your_reviews'),
    'no_reviews_message' => __('review.haven\'t_review_any'),
])

@php
    $reviews = \App\Models\UserReview::where('user_id', $reviewUser->id)->where('is_visible', true)->paginate(5);
@endphp

<div {{ $attributes->merge(['class' => 'w-full gap-4']) }}>
    <h1 class="font-bold text-xl capitalize mb-8">{{ $title }}:</h1>
    @if (count($reviews) > 0)
        @foreach ($reviews as $review)
            <div class="p-4 mb-8 border rounded-lg border-black/20 dark:border-white/20">
                <div class="flex flex-col">
                    <span data-href="{{ route('book.detail', [$review->book->id, $review->book->slug]) }}"
                        data-target="_blank"
                        class="inline-flex items-center font-semibold text-lg hover:underline cursor-pointer">{{ $review->book->title }}
                        <i class="ti ti-external-link ml-auto"></i></span>
                    <span
                        class="text-xs font-semibold text-black/40 dark:text-white/40">{{ \App\Helpers\TimeHelper::timeAgo($review->created_at) }}</span>
                </div>
                <div class="my-4">
                    <x-rating :rate="$review->rating" :scale="5" />
                </div>

                <x-show-more :text="$review->review_text" class="text-justify" isMarkdown />
            </div>
        @endforeach
    @else
        <p class="text-center text-neutral-500">{!! $no_reviews_message !!}.</p>
    @endif
    {{ $reviews->links('pagination.paginator') }}
</div>
