<style>
    .error {
        color: red;
        font-weight: 400;
    }
</style>

{{-- <div class="form-group">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Rounds</th>
                <th scope="col">Type</th>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
                <th scope="col">Duration</th>
                <th scope="col">Feedback</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @if ($interviewEmpoloyeeRounds)
            @php $counter = 1 @endphp
                @foreach ($interviewEmpoloyeeRounds as $interviewEmpoloyeeRound)
                    <tr>
                        <th scope="row">{{ $counter }}</th>
                        <td>{{ $interviewEmpoloyeeRound->title}}</td>
                        <td>{{ $interviewEmpoloyeeRound->interview_date}}</td>
                        <td>{{ $interviewEmpoloyeeRound->interview_start_time}}</td>
                        <td>{{ $interviewEmpoloyeeRound->duration}}</td>
                        <td>{{ $interviewEmpoloyeeRound->interview_feedback}}</td>
                        <td>{{ $interviewEmpoloyeeRound->interviewer_status}}</td>
                    </tr>
                    @php $counter++ @endphp
                @endforeach    
            @endif
        </tbody>
    </table>
</div> --}}
<div class="form-group">
    @if($checkfeedback)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Feedback Points</th>
                <th scope="col">Rating</th>
            </tr>
        </thead>
        @if ($interviewEmpoloyeeFeedback)
        @php $counter = 1 @endphp
            @foreach ($interviewEmpoloyeeFeedback as $interviewEmpoloyeeFeed)
                <tr>
                    <th scope="row">{{ $counter }}</th>
                    <td>{{ $interviewEmpoloyeeFeed->title}}</td>
                    <td>{{ $interviewEmpoloyeeFeed->feedback_rating}}</td>
                </tr>
                @php $counter++ @endphp
            @endforeach              
        @endif
    </table>
    @else
    <p>Feedback not yet</p>
    @endif
</div>


