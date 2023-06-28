<!DOCTYPE html>
<html lang="en">

<head>
    <title>ByteCipher - Suggest a new time</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <link rel="icon" href="{{ asset('assets') }}/admin/web-email//images/logo-icon.png">
    <link rel="stylesheet" href="{{ asset('assets') }}/admin/web-email//css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/admin/web-email//css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/admin/web-email//css/my-css.css">

    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <script src="{{ asset('assets') }}/admin/js/jquery.min.js"></script>

</head>

<body>

    <header>
        <div class="container">
            <div class="navigation-wrap start-header start-style">
                <nav class="navbar navbar-expand-md navbar-light">
                    <a class="navbar-brand" href="#"><img
                            src="{{ asset('assets') }}/admin/web-email/images/logo.png" alt=""></a>

                </nav>
            </div>
        </div>
    </header>

    <div class="scheduPage">
        <div class="container">
            <div class="scheduBox">
                <h1>Your feedback is very important to us.</h1>
                <form action="" method="post">
                    @csrf
                    <div class="ul-part">
                        <div class="">
                            {{-- <h2>Interview Status</h2></br> --}}
                            @if($feedbackRespons)
                                 <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Feedback Points</th>
                                        <th>Feedback Rating</th>
                                     </tr>
                                    </thead>
                                    @php $num = 0 @endphp
                                    @foreach($feedbackResponse as $feedback) 
                                    <input type="hidden" name="feedback_id[]" value={{$feedback->id}}>
                                    <input type="hidden" name="interview_round_id[]" id="interviewEmpRoundsId" value="{{ $interviewEmpRoundsId }}">
                                    <tbody>
                                     <tr>
                                       <td>{{ $feedback->title}}</td> 
                                       <td>
                                        {{-- <select class="form-control" id="feedback_rating" name="feedback_rating[{{$i}}]">  
                                            <option value = "0"> 0 </option>  
                                            <option value = "1"> 1 </option>  
                                            <option value = "2"> 2</option>  
                                            <option value = "3"> 3 </option>  
                                            <option value = "4"> 4 </option>  
                                            <option value = "5"> 5 </option>  
                                            <option value = "6"> 6 </option>  
                                            <option value = "7"> 7 </option>  
                                            <option value = "8"> 8</option>  
                                            <option value = "9"> 9 </option>  
                                            <option value = "10"> 10 </option>  
                                            </select> --}}
                                            <span> <label class="" for="rating1">1</label> 
                                                 <input type="radio" id="rating1" name="feedback_rating[{{$num}}]" class=""  value="1" checked=""></span>  
                                            <span> <label class="" for="rating2">2</label> 
                                                 <input type="radio" id="rating2" name="feedback_rating[{{$num}}]" class="" value="2"> </span>
                                            <span><label class="" for="rating3">3</label> 
                                                 <input type="radio" id="rating3" name="feedback_rating[{{$num}}]" class=""  value="3"> </span>  
                                            <span> <label class="" for="rating4">4</label> 
                                                <input type="radio" id="rating4" name="feedback_rating[{{$num}}]" class="" value="4"></span>
                                            <span><label class="" for="rating5">5</label>  
                                                <input type="radio" id="rating5" name="feedback_rating[{{$num}}]" class=""  value="5">  </span>  
                                            <span> <label class="" for="rating6">6</label> 
                                                 <input type="radio" id="rating6" name="feedback_rating[{{$num}}]" class="" value="6"> </span>
                                            <span> <label class="" for="rating7">7</label> 
                                                 <input type="radio" id="rating7" name="feedback_rating[{{$num}}]" class=""  value="7"> </span>  
                                            <span> <label class="" for="rating8">8</label> 
                                                 <input type="radio" id="rating8" name="feedback_rating[{{$num}}]" class="" value="8"> </span>
                                            <span> <label class="" for="rating9">9</label>  
                                                <input type="radio" id="rating9" name="feedback_rating[{{$num}}]" class=""  value="9" > </span>  
                                            <span><label class="" for="rating10">10</label>  
                                                <input type="radio" id="rating10" name="feedback_rating[{{$num}}]" class="" value="10">  </span>
                                                           
                                       </td>
                                    </tr>  
                                    </tbody>
                                    @php $num++ @endphp
                                    @endforeach
                                </table>
                            
                               @endif
                            {{-- <select class="form-control" id="interviewer_status" name="interviewer_status">
                                <option value="Unclear">Not Clear</option>
                                <option value="Clear">Clear</option>
                            </select> --}}
                        </div>
                        <div class="">
                            <input type="hidden" name="interviewEmpRoundsId" id="interviewEmpRoundsId" value="{{ $interviewEmpRoundsId }}">
                            <h2>Feedback comment</h2>
                            <textarea rows="3" name="interview_feedback" class="form-textarea"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="buttun-classA">Submit Feedback</button>
                </form>

            </div>
        </div>
    </div>



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>
        window.jQuery || document.write('<script src="../..{{ asset('assets') }}/admin/js/vendor/jquery.min.js"><\/script>')
    </script>
    <script src="{{ asset('assets') }}/admin/js/bootstrap.min.js"></script>

</body>

</html>
