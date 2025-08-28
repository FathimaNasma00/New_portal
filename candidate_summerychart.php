  <section class="section">
      <div class="row">
           <!-- Day Donut Pie Chart Traffic -->
           <div class="col-6">
          <div class="card">
            <div class="card-body pb-0">
              <h5 class="card-title">Day Summery<span>| Today</span></h5>
    
                 	<div class="card-body pie-chart">
                         <canvas id="daydoughnut_chart"  class="echart"></canvas>
                    </div>
            </div>
            <input type="hidden" name="post_id" id="post_id" value="<?php echo $_SESSION['login_id']; ?>"> 
            <script>
	
    $(document).ready(function(){
    /*------------------------------- Today ---------------------------------------------*/ 

	makechart();
	function makechart()
	{
	    var post_id = $('#post_id').val();
	    
		$.ajax({
			url:"homepiechrtdata.php",
			method:"POST",
			data:{action:'today', post_id:post_id},
			dataType:"JSON",
			success:function(data)
			{
				var language = [];
				var total = [];
				var color = [];

				for(var count = 0; count < data.length; count++)
				{
					language.push(data[count].language);
					total.push(data[count].total);
					color.push(data[count].color);
				}

				var chart_data = {
					labels:language,
					datasets:[
						{
							label:'Total',
							backgroundColor:color,
							color:'#fff',
							data:total
						}
					]
				};

				var options = {
					responsive:true,
					scales:{
						yAxes:[{
							ticks:{
								min:0
							}
						}]
					}
				};

				var group_chart1 = $('#pie_chart');

				var graph1 = new Chart(group_chart1, {
					type:"pie",
					data:chart_data
				});

				var group_chart2 = $('#daydoughnut_chart');

				var graph2 = new Chart(group_chart2, {
					type:"doughnut",
					data:chart_data
				});

				var group_chart3 = $('#bar_chart');

				var graph3 = new Chart(group_chart3, {
					type:'bar',
					data:chart_data,
					options:options
				});
			}
		})
	}

});

</script>
          </div>
          </div>
          <!-- Day End Donut Pie Chart Traffic -->
          
          <!-- Week Donut Pie Chart Traffic -->
           <div class="col-6">
          <div class="card">
            <div class="card-body pb-0">
              <h5 class="card-title">Weekly Summery<span>|This Week</span></h5>
     
              
                 	<div class="card-body pie-chart">
                         <canvas id="weekdoughnut_chart"  class="echart"></canvas>
                    </div>
            </div>
            <input type="hidden" name="post_id" id="post_id" value="<?php echo $_SESSION['login_id']; ?>"> 
            <script>
	
    $(document).ready(function(){
    /*------------------------------- Today ---------------------------------------------*/ 

	makechart();
	function makechart()
	{
	    var post_id = $('#post_id').val();
	    
		$.ajax({
			url:"homepiechrtdata.php",
			method:"POST",
			data:{action:'week', post_id:post_id},
			dataType:"JSON",
			success:function(data)
			{
				var language = [];
				var total = [];
				var color = [];

				for(var count = 0; count < data.length; count++)
				{
					language.push(data[count].language);
					total.push(data[count].total);
					color.push(data[count].color);
				}

				var chart_data = {
					labels:language,
					datasets:[
						{
							label:'Total',
							backgroundColor:color,
							color:'#fff',
							data:total
						}
					]
				};

				var options = {
					responsive:true,
					scales:{
						yAxes:[{
							ticks:{
								min:0
							}
						}]
					}
				};

				var group_chart1 = $('#pie_chart');

				var graph1 = new Chart(group_chart1, {
					type:"pie",
					data:chart_data
				});

				var group_chart2 = $('#weekdoughnut_chart');

				var graph2 = new Chart(group_chart2, {
					type:"doughnut",
					data:chart_data
				});

				var group_chart3 = $('#bar_chart');

				var graph3 = new Chart(group_chart3, {
					type:'bar',
					data:chart_data,
					options:options
				});
			}
		})
	}

});

</script>
          </div>
          </div>
          <!-- week End Donut Pie Chart Traffic -->
          
          <!-- Month Donut Pie Chart Traffic -->
           <div class="col-6">
          <div class="card">
            <div class="card-body pb-0">
              <h5 class="card-title">Month Summery<span>|This Month</span></h5>
                 	<div class="card-body pie-chart">
                         <canvas id="monthdoughnut_chart"  class="echart"></canvas>
                    </div>
            </div>
            <input type="hidden" name="post_id" id="post_id" value="<?php echo $_SESSION['login_id']; ?>"> 
            <script>
	
    $(document).ready(function(){
    /*------------------------------- Today ---------------------------------------------*/ 

	makechart();
	function makechart()
	{
	    var post_id = $('#post_id').val();
	    
		$.ajax({
			url:"homepiechrtdata.php",
			method:"POST",
			data:{action:'month', post_id:post_id},
			dataType:"JSON",
			success:function(data)
			{
				var language = [];
				var total = [];
				var color = [];

				for(var count = 0; count < data.length; count++)
				{
					language.push(data[count].language);
					total.push(data[count].total);
					color.push(data[count].color);
				}

				var chart_data = {
					labels:language,
					datasets:[
						{
							label:'Total',
							backgroundColor:color,
							color:'#fff',
							data:total
						}
					]
				};

				var options = {
					responsive:true,
					scales:{
						yAxes:[{
							ticks:{
								min:0
							}
						}]
					}
				};

				var group_chart1 = $('#pie_chart');

				var graph1 = new Chart(group_chart1, {
					type:"pie",
					data:chart_data
				});

				var group_chart2 = $('#monthdoughnut_chart');

				var graph2 = new Chart(group_chart2, {
					type:"doughnut",
					data:chart_data
				});

				var group_chart3 = $('#bar_chart');

				var graph3 = new Chart(group_chart3, {
					type:'bar',
					data:chart_data,
					options:options
				});
			}
		})
	}

});

</script>
          </div>
          </div>
          <!-- Month End Donut Pie Chart Traffic -->
          
          <!-- year Donut Pie Chart Traffic -->
           <div class="col-6">
          <div class="card">
            <div class="card-body pb-0">
              <h5 class="card-title">Year Summery<span>|This Year</span></h5>
                 	<div class="card-body pie-chart">
                         <canvas id="yeardoughnut_chart"  class="echart"></canvas>
                    </div>
            </div>
            <input type="hidden" name="post_id" id="post_id" value="<?php echo $_SESSION['login_id']; ?>"> 
            <script>
	
    $(document).ready(function(){
    /*------------------------------- Today ---------------------------------------------*/ 

	makechart();
	function makechart()
	{
	    var post_id = $('#post_id').val();
	    
		$.ajax({
			url:"homepiechrtdata.php",
			method:"POST",
			data:{action:'year', post_id:post_id},
			dataType:"JSON",
			success:function(data)
			{
				var language = [];
				var total = [];
				var color = [];

				for(var count = 0; count < data.length; count++)
				{
					language.push(data[count].language);
					total.push(data[count].total);
					color.push(data[count].color);
				}

				var chart_data = {
					labels:language,
					datasets:[
						{
							label:'Total',
							backgroundColor:color,
							color:'#fff',
							data:total
						}
					]
				};

				var options = {
					responsive:true,
					scales:{
						yAxes:[{
							ticks:{
								min:0
							}
						}]
					}
				};

				var group_chart1 = $('#pie_chart');

				var graph1 = new Chart(group_chart1, {
					type:"pie",
					data:chart_data
				});

				var group_chart2 = $('#yeardoughnut_chart');

				var graph2 = new Chart(group_chart2, {
					type:"doughnut",
					data:chart_data
				});

				var group_chart3 = $('#bar_chart');

				var graph3 = new Chart(group_chart3, {
					type:'bar',
					data:chart_data,
					options:options
				});
			}
		})
	}

});

</script>
          </div>
          </div>
          <!-- year End Donut Pie Chart Traffic -->
      </div>
    </section>