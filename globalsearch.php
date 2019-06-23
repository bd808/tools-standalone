<?php

/*   ---------------------------------------------

Author : James Alexander

License: MIT (see http://opensource.org/licenses/MIT and LICENSE.txt which
should be in the root folder with this file)

Date of creation : 2014-03-04

Quick and Dirty cross wiki search function for Wikimedia Wikis. Will make better later.

---------------------------------------------   */

ini_set( 'max_execution_time', 300 );

require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;

// Create the global request object.
$request = Request::createFromGlobals();

$originalapiurl = 'https://meta.wikimedia.org/w/api.php';
?>

<!DOCTYPE html>
<html lang='en-US'>
<head>
	<title>Global Search (ALPHA)</title>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	<link href="css/main.css" rel="stylesheet" />
	<link href="css/lca.css" rel="stylesheet" />
	<style type="text/css">
		.external, .external:visited { color: #222222; }
		.autocomment{color:gray}
	</style>
	<script
		src="https://code.jquery.com/jquery-1.12.4.min.js"
		integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
		crossorigin="anonymous"></script>
	<script type="text/javascript">
	$(document).ready(function(){

		 $('#checkall').click( function() {
			 $("input[name='ns[]']").prop('checked', true);
		 })

		 $('#uncheckall').click( function() {
			 $("input[name='ns[]']").prop('checked', false);
		 })

	})
	</script>
</head>
<body class='mediawiki'>
	<div id='globalWrapper'>
		<div id='column-content'>
			<div id='content'>
				<h1>Global Search (ALPHA)</h1>
				<br />
			<?php if ( !$request->request->has( 'searchfor' ) ) : ?>
				<fieldset>
					<legend>
						What do you want to search for? Please note this will search ALL
						wikis and may take time.
					</legend>
					<b>
						Note: If you search the File name space, commons files will show
						up for ALL wikis
					</b>
					<br />
					<u>Remember to do anything in the search box you normally would for
						a search (especially using quotes if you want to look only for a
						specific phrase)
					</u>
					<form id='inputform' method='POST'>
					<table>
						<tr>
							<td></td>
						</tr>
						<tr>
							<td> <label for='searchfor'> Search for: </label>
							<td>
								<input id='searchfor' name='searchfor' size='30' type='td' value=''>
							</td>
						</tr>
							<td>
								<table>
									<tr>
										<td>
											<input id='ns0' name='ns[]' type='checkbox' value='0'>
											<label for='ns0'>Main</label>
										</td>
										<td>
											<input id='ns1' name='ns[]' type='checkbox' value='1'>
											<label for='ns1'>Talk</label>
										</td>
									</tr>
									<tr>
										<td>
											<input id='ns2' name='ns[]' type='checkbox' value='2'>
											<label for='ns2'>User</label>
										</td>
										<td>
											<input id='ns3' name='ns[]' type='checkbox' value='3'>
											<label for='ns3'>User talk</label>
										</td>
									</tr>
									<tr>
										<td>
											<input id='ns4' name='ns[]' type='checkbox' value='4'>
											<label for='ns4'>Project</label>
										</td>
										<td>
											<input id='ns5' name='ns[]' type='checkbox' value='5'>
											<label for='ns5'>Project talk</label>
										</td>
									</tr>
									<tr>
										<td>
											<input id='ns6' name='ns[]' type='checkbox' value='6'>
											<label for='ns6'>File</label>
										</td>
										<td>
											<input id='ns7' name='ns[]' type='checkbox' value='7'>
											<label for='ns7'>File talk</label>
										</td>
									</tr>
								</table>
							</td>
							<td>
								<table>
									<tr>
										<td>
											<input id='ns8' name='ns[]' type='checkbox' value='8'>
											<label for='ns8'>MediaWiki</label>
										</td>
										<td>
											<input id='ns9' name='ns[]' type='checkbox' value='9'>
											<label for='ns9'>MediaWiki talk</label>
										</td>
									</tr>
									<tr>
										<td>
											<input id='ns10' name='ns[]' type='checkbox' value='10'>
											<label for='ns10'>Template</label>
										</td>
										<td>
											<input id='ns11' name='ns[]' type='checkbox' value='11'>
											<label for='ns11'>Template talk</label>
										</td>
									</tr>
									<tr>
										<td>
											<input id='ns12' name='ns[]' type='checkbox' value='12'>
											<label for='ns12'>Help</label>
										</td>
										<td>
											<input id='ns13' name='ns[]' type='checkbox' value='13'>
											<label for='ns13'>Help talk</label>
										</td>
									</tr>
									<tr>
										<td>
											<input id='ns14' name='ns[]' type='checkbox' value='14'>
											<label for='ns14'>Category</label>
										</td>
										<td>
											<input id='ns15' name='ns[]' type='checkbox' value='15'>
											<label for='ns15'>Category talk</label>
										</td>
									</tr>
								</table>
							</td>
							<td>
								<table>
									<tr>
										<td>
											<input id='ns100' name='ns[]' type='checkbox' value='100'>
											<label for='ns100'>Portal</label>
										</td>
										<td>
											<input id='ns101' name='ns[]' type='checkbox' value='101'>
											<label for='ns101'>Portal talk</label>
										</td>
									</tr>
									<tr>
										<td>
											<input id='ns108' name='ns[]' type='checkbox' value='108'>
											<label for='ns108'>Book</label>
										</td>
										<td>
											<input id='ns109' name='ns[]' type='checkbox' value='109'>
											<label for='ns109'>Book talk</label>
										</td>
									</tr>
									<tr>
										<td>
											<input id='ns118' name='ns[]' type='checkbox' value='118'>
											<label for='ns118'>Draft</label>
										</td>
										<td>
											<input id='ns119' name='ns[]' type='checkbox' value='119'>
											<label for='ns119'>Draft talk</label>
										</td>
									</tr>
									<tr>
										<td>
											<input id='ns446' name='ns[]' type='checkbox' value='446'>
											<label for='ns446'>Education Program</label>
										</td>
										<td>
											<input id='ns447' name='ns[]' type='checkbox' value='447'>
											<label for='ns447'>Education Program talk</label>
										</td>
									</tr>
								</table>
							</td>
							<td>
								<table>
									<tr>
										<td>
											<input id='ns828' name='ns[]' type='checkbox' value='828'>
											<label for='ns828'>Module</label>
										</td>
										<td>
											<input id='ns829' name='ns[]' type='checkbox' value='829'>
											<label for='ns829'>Module talk</label>
										</td>
									</tr>
									<tr>
										<td>
											<input id='ns200' name='ns[]' type='checkbox' value='200'>
											<label for='ns200'>Grants</label>
										</td>
										<td>
											<input id='ns201' name='ns[]' type='checkbox' value='201'>
											<label for='ns201'>Grants talk</label>
										</td>
									</tr>
									<tr>
										<td>
											<input id='ns202' name='ns[]' type='checkbox' value='202'>
											<label for='ns202'>Research</label>
										</td>
										<td>
											<input id='ns203' name='ns[]' type='checkbox' value='203'>
											<label for='ns203'>Research talk</label>
										</td>
									</tr>
									<tr>
										<td>
											<input id='ns208' name='ns[]' type='checkbox' value='208'>
											<label for='ns208'>Programs</label>
										</td>
										<td>
											<input id='ns209' name='ns[]' type='checkbox' value='209'>
											<label for='ns209'>Programs talk</label>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td> <a href="#" id='uncheckall'>(none)</a> <a href="#" id='checkall'>(all)</a>
						<tr>
							<td> <input type='submit' value='Search' />
						</tr>
					</table>
				</fieldset>
			<?php else: ?>
				<fieldset>
					<legend> Results: </legend>
					<table border='1' id='results'></table>
				</fieldset>
			<?php endif; ?>

				</div>
		</div>
	</div>
	<?php
flush();
if ( $request->request->has( 'searchfor' ) ) {
	$searchfor = $request->request->get( 'searchfor' );
	$query = [
		'action' => 'sitematrix',
		'format' => 'json',
	];

	$ch = curl_init();

	curl_setopt( $ch, CURLOPT_POST, true );
	curl_setopt( $ch, CURLOPT_URL, $originalapiurl );
	curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $query ) );
	curl_setopt( $ch, CURLOPT_HEADER, 0 );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
	$jsonresponse = curl_exec( $ch );
	if ( !$jsonresponse ) {
		echo json_encode( 'Curl error: ' . htmlspecialchars( curl_error( $ch ) ) );
	}

	$response = json_decode( $jsonresponse, true );
	$sites = [];

	foreach ( $response['sitematrix'] as $key => $langarray ) {
		if ( $key != 'count' && $key != 'specials' ) {
			foreach ( $langarray['site'] as $langkey => $sitearray ) {
					$sites[] = $sitearray;
			}
		}
	}

	foreach ( $response['sitematrix']['specials'] as $key => $sitearray ) {
		$sites[] = $sitearray;
	}

	foreach ( $sites as $key => $sitearray ) {
		$siteurl = preg_replace( "/^http:/", "https:", $sitearray['url'], 1 );
		$apiurl = $siteurl . '/w/api.php';
		$dbname = $sitearray['dbname'];
		echo '<script> $("#results").append("<tr><th> <a href=\''.$siteurl.'\' target=\'_blank\'>'.$dbname.'</a></th></tr>");</script>';
		if ( array_key_exists( 'closed', $sitearray ) ) {
			echo '<script> $("#results").append("<tr><td style=\'font-weight:bold;\'> Closed Wiki, Skipping </td</tr>");</script>';
			continue;
		} elseif ( array_key_exists( 'private', $sitearray ) ) {
			echo '<script> $("#results").append("<tr><td style=\'font-weight:bold;\'> Private Wiki, Skipping </td</tr>");</script>';
			continue;
		} elseif ( array_key_exists( 'fishbowl', $sitearray ) ) {
			echo '<script> $("#results").append("<tr><td style=\'font-weight:bold;\'> Fishbowl Wiki, Skipping </td</tr>");</script>';
			continue;
		}

		$query = [
			'action' => 'query',
			'format' => 'json',
			'list' => 'search',
			'srinfo' => 'totalhits',
			'srredirects' => 'true',
			'srwhat' => 'text',
			'srsearch' => $searchfor,
			'srprop' => 'snippet|sectiontitle|titlesnippet',
			'srlimit' => 'max',
		];

		if ( $request->request->has( 'ns' ) ) {
			$srnamespace = implode( '|', $request->request->get( 'ns' ) );
			$query['srnamespace'] = $srnamespace;
		}

		a:

		curl_setopt( $ch, CURLOPT_POST, true );
		curl_setopt( $ch, CURLOPT_URL, $apiurl );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $query ) );
		curl_setopt( $ch, CURLOPT_HEADER, 0 );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		$jsonresponse = curl_exec( $ch );
		$response = json_decode( $jsonresponse, true );

		if ( $response ) {
			if ( $response['query']['searchinfo']['totalhits'] > 0 ) {
				$searchresults = $response['query']['search'];
				foreach ( $searchresults as $key => $result ) {
					$location = $siteurl.'/wiki/'.$result['title'];
					if ( isset( $result['sectiontitle'] ) ) {
						$location = $location.'#'.$result['sectiontitle'];
						$location = json_encode( utf8_encode( $location ) );
					}
					echo '<script> $("#results").append("<tr><td><a href=\''.htmlentities( $location, ENT_QUOTES ).'\' target=\'_blank\'>'.$location.'</a></td></tr>");</script>';
					flush();
					if ( isset( $result['snippet'] ) ) {
						echo '<script> $("#results").append("<tr><td>'.$result['snippet'].'</td></tr>");</script>';
						flush();
					}
				}
			} else {
				echo '<script> $("#results").append("<tr><td>No search results found</td></tr>");</script>';
			}

			if ( array_key_exists( 'query-continue', $response ) ) {
				$offset = $response['query-continue']['search']['sroffset'];
				$query['sroffset'] = $offset;
				//FIXME DONT USE GOTO
				goto a;
			}
		} else {
			echo '<script> $("#results").append("<tr><td style=\'color:red;\'>There was an error with this search. If the wiki exists this appears it appears that you don\'t have an account on it. <br /> You may want to do a manual search on the wiki (click above) or re run this search after you have visited the wiki with the link above and seen your username in the top right corner. </td></tr>");</script>';
		}

	}
	echo '<script> $("#results").append("<tr><th>DONE!</th></tr>");</script>';

}
?>
</body>
</html>
