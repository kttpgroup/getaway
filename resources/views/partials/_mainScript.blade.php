<!-- Scripts -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- Latest compiled and minified JavaScript -->
    <!-- jQuery -->
       <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>


    {!! Html::script('js/typeahead.js') !!}

    

    <script type="text/javascript">
    	$(document).ready(function() {
    		

    		var users = new Bloodhound({
    			
    			remote:{
    				url: '/autocomplete/%QUERY',
    				wildcard: '%QUERY'
    			},
    			datumTokenizer: Bloodhound.tokenizers.whitespace('name'),
    			queryTokenizer: Bloodhound.tokenizers.whitespace
    		});

    		users.initialize();
            var x = jQuery.noConflict();

    		x("#users").typeahead({
    			hint: true,
    			highlight: true,
    			minLength: 2
    		}, {
    			name: 'name',
    			displayKey: 'name',
    			source: users.ttAdapter()
    		});
    	});
    </script>