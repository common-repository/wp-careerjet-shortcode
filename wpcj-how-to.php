<h2 style="color:#F60;font-size:24px">Using the Job Listings Shortcode</h2>

<p>Use the <span style="color:#076CB6;">[wpcj]</span> shortcode to quickly insert Careerjet job listings on any page or post. The shortcode accepts a variety of parameters to refine the job listings.</p>

<img style="max-width:100%; height:auto;" src="<?php echo plugins_url( 'img/job-listing.png' , __FILE__ );?>" />

<p><strong>Available Shortcode Parameters:</strong></p>
<ul style="list-style:unset; margin-left:40px;">
<li>Q = job description you want to search for</li>
<li>L = location you want to search for</li>
<li>RESULTS = the number of job listings to return (default is 10)</li>
<li>LENGTH = number of characters in the job description (default is 200)</li>
<li>CONTRACTTYPE = filter job listings by type ("p" for permanent, "c" for contract, "t" for temporary, "i" for training, "v" for voluntary)</li>
<li>CONTRACTPERIOD = filter job listings by time base ("p" for part-time, "f" for full-time)</li>
<li>SORT = sort job order by "date" or "salary"</li>
<li>LIST = display a basic bulleted list instead of full job listing (use list="1")</li>
</ul>

<p><strong>Examples:</strong></p>
<div style="margin-left:30px;">
<p><span style="color:#076CB6;">[wpcj <strong>q="Java Developer"</strong>]</span> - 10 Java Developer listings. Will use visitors geo-location since no location provided.</p>
<p><span style="color:#076CB6;">[wpcj q="Java Developer" <strong>l="Austin, TX"</strong>]</span> - 10 Java Developer listings in Austin, TX.</p>
<p><span style="color:#076CB6;">[wpcj q="PHP Programmer" <strong>results="20"</strong>]</span> - 20 PHP Programmer listings (will use geo location of user since no location was provided).</p>
<p><span style="color:#076CB6;">[wpcj q="Data Scientist" l="Boston, MA" <strong>length="150"</strong>]</span> - Reduce job description to 150 characters.</p>
<p><span style="color:#076CB6;">[wpcj q="Data Scientist" l="Boston, MA" <strong>contracttype="p"</strong>]</span> - Show only permanent positions.</p>
<p><span style="color:#076CB6;">[wpcj q="Data Scientist" l="Boston, MA" <strong>contractperiod="f"</strong>]</span> - Show only full-time positions.</p>
<p><span style="color:#076CB6;">[wpcj q="Data Scientist" l="Boston, MA" <strong>sort="salary"</strong>]</span> - Sort job results by salary.</p>
<p><span style="color:#076CB6;">[wpcj q="Data Scientist" l="Boston, MA" <strong>list="1"</strong>]</span> - Show a simple bulleted list of job results.</p>
</div>
<p>&nbsp;</p>
<hr/>

<h2 style="color:#F60;font-size:24px">Using the Searchbox Shortcode <span style="color: #0073aa; font-size: 11px;"><a href="#top">(top)</a></span></h2>
<p>Use the <span style="color:#076CB6;">[wpcj_searchbox]</span> shortcode to quickly insert a Careerjet job search form on any post or page.</p>

<img style="max-width:100%; height:auto;" src="<?php echo plugins_url( 'img/search-box.png' , __FILE__ );?>" width="500"/>