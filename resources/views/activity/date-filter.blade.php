<label>From <input class="form-control" type="date" name="from" value="{{ request('from', now(config('activity.timezone'))->subDays(29)->toDateString()) }}" required></label>
<label>To <input class="form-control" type="date" name="to" value="{{ request('to', now(config('activity.timezone'))->toDateString()) }}" required></label>
