<div class='flex text-gray-700 font-normal text-sm rounded-md items-center pl-1 pr-1'>
    <div class="hover:text-green-600 text-grey-darker text-2xl">
        <a wire:click.prevent="upvote(1)" href="#">+</a>
    </div>

    <div class="m-1 pt-1 text-gray-400 font-thin text-ms">
        {{ $rating_sum }}
    </div>

    <div class="hover:text-red-600 text-grey-darker text-2xl">
        <a wire:click.prevent="downvote(1)" href="#">-</a>
    </div>
</div>
