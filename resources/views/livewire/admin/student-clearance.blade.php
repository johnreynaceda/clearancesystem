<div>
    <div>
        {{ $this->form }}
    </div>
    <div class="mt-5">
        @if ($student_id)
            {{ $this->table }}
        @endif
    </div>
</div>
