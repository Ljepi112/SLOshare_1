    <section class="panelV2">
@if ($poll && $poll->voters->where('user_id', '=', auth()->user()->id)->isEmpty())
        <div class="panel panel-danger">
            <div class="panel-heading">
                <h4 class="text-center">
                    <div class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" style="color:#ffffff;">
                        <i class="{{ config('other.font-awesome') }} fa-chart-pie"></i> {{ __('poll.poll') }}
                    </div>
                </h4>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" method="POST" action="/polls/vote">
                    @csrf
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {!! csrf_field() !!}

                    @if ($poll->multiple_choice)
                        @foreach ($poll->options as $option)
                            <div class="poll-slo">
                                <label>
                                    <input type="checkbox" name="option[]" value="{{ $option->id }}">
                                    <span class="badge-user">{{ $option->name }}</span>
                                </label>
                            </div>
                        @endforeach
                    @else
                        @foreach ($poll->options as $option)
                            <div class="poll-slo">
                                <label>
                                    <input type="radio" name="option[]" value="{{ $option->id }}" required>
                                    <span class="badge-user">{{ $option->name }}</span>
                                </label>
                            </div>
                        @endforeach
                    @endif

                    <div class="poll form-group">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">{{ __('poll.vote') }}</button>
                        </div>
                    </div>
                </form>
                @if ($poll->multiple_choice)
                    <span class="badge-user text-bold text-red poll-note">{{ __('poll.multiple-choice') }}</span>
                @endif
            </div>
        </div>
@else
        <div class="panel panel-danger">
            <div class="panel-heading">
                <h4 class="text-center">
                    <div class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" style="color:#ffffff;">
                        <i class="{{ config('other.font-awesome') }} fa-chart-pie"></i> {{ __('poll.poll') }}
                    </div>
                </h4>
            </div>
        <h2 class="panel__heading"></h2>
            <div class="panel-body">
            @php($total = $poll->options->sum('votes'))
            @foreach ($poll->options as $option)
                <p class="form__group">
                    <label class="form__label" for="option{{ $loop->iteration }}">
                        {{ $option->name }} ({{ \number_format($total === 0 ? 0 : 100 * $option->votes / $total, 2) }}%)
                    </label>
                    <meter
                        id="option{{ $loop->iteration }}"
                        class="form__meter"
                        min="0"
                        max="{{ $total }}"
                        value="{{ $option->votes }}"
						style="color: var(--color-magenta)!important;"
                    >
                        {{ $option->votes }} {{ $option->votes === 1 ? __('poll.vote') : __('poll.votes') }}
                    </meter>
                </p>
            @endforeach
            </div>
        </div>
@endif
	</section>