<style>
    .error {
        color: red;
        font-weight: 400;
    }
</style>

@if($checkfeedback)

  <div class="form-group">   
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
                    <td>{{ $interviewEmpoloyeeFeed->feedback_rating}}/10</td>
                    {{-- <td>{{ $checkfeedback->interview_feedback}}</td>     --}}
                  </tr> 
                    @php $counter++ @endphp
            @endforeach        
        @endif
    </table>    
</div>

    @if($checkfeedback->interview_feedback)
        <div class="form-group">
        <label for="">Feedback Comment:</label>    
            {{ $checkfeedback->interview_feedback}}                
        </div>
    @endif

@else
   <p>Feedback not yet</p>
@endif


