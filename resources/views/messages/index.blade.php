<div class="message-wrapper flex flex-col">
        @foreach ($messages as $message)
            {{-- if message from id is equal to auth id then it is sent by logged in user --}}
            <div class="{{ $message->from === Auth::id() ? 'sent self-end' : 'received' }} block">
                <p>{{ $message->message }}</p>
                <p class="date">{{ date('d M y, h:i a', strtotime($message->created_at)) }}</p>
            </div>
        @endforeach
</div>

<div class="input-text">
    <input type="text" name="message" class="submit">
</div>
