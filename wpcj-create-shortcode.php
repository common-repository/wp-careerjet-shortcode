<?php 

echo '<script src="' . plugins_url( 'js/wpcj-create-shortcode.js', __FILE__ ) . '" ></script>'; 

?>

<form id="wpcj-shortcode-creator" method="post">
   <table class="form-table">
      <tbody>
         <tr>
            <th scope="row">Location</th>
            <td><input type="text" id="sc-location" value=""/></td>
         </tr>
         <tr>
            <th scope="row">Job Title</th>
               <td><input type="text" id="sc-job-title" value=""/></td>
            </th>
         </tr>
         <tr>
            <th scope="row"># of Job Listings to Show</th>
               <td><input type="text" id="sc-job-listings" maxlength="2" size="2" value=""/> (default is 10)</td>
            </th>
         </tr>
         <tr>
            <th scope="row">Length of Job Description (characters)</th>
               <td><input type="text" id="sc-length" value=""/> (default/max is 200)</td>
            </th>
         </tr>
         <tr>
            <th scope="row">Filter by Position Type</th>
               <td>
		  <select id="sc-contract-type">
		     <option value="all">Default</option>
		     <option value="p">Permanent</option>
		     <option value="c">Contract</option>
		     <option value="t">Temporary</option>
		     <option value="i">Training</option>
		     <option value="v">Voluntary</option>
		  </select>
	       </td>
            </th>
         </tr>
         <tr>
            <th scope="row">Filter by Contract Period</th>
               <td>
		  <select id="sc-contract-period">
		     <option value="all">Default</option>
		     <option value="f">Full-Time Only</option>
		     <option value="p">Part-Time Only</option>
		  </select>
	       </td>
            </th>
         </tr>
         <tr>
            <th scope="row">Sort Order by</th>
               <td>
		  <select id="sc-sort">
		     <option value="relevance">Default</option>
		     <option value="date">Date Posted</option>
		     <option value="salary">Salary</option>
		  </select>
	       </td>
            </th>
         </tr>
         <tr>
            <th scope="row">Bulleted List Format?</th>
               <td>
		  Yes <input type="radio" id="sc-list-yes" name ="scList" />
		  No <input type="radio" id="sc-list-no" name ="scList" checked="checked" />
	       </td>
            </th>
         </tr>
      </tbody>
   </table>

<input type="submit" onclick="return wpcj_create_shortcode()" value="Get Shortcode">

<p align="center"> YOUR SHORTCODE:</p>
<p align="center"><textarea id="display" value="" style="width:500px; color:#ff0000; text-align:center;"/></textarea></p>
</form>