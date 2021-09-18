<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<title><?php echo getTopTitle() . " - " . $title ?></title>

	<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<!------ Include the above in your HEAD tag ---------->

	<style type="text/css">
		.invoice-title h2,
		.invoice-title h3 {
			display: inline-block;
		}

		.table>tbody>tr>.no-line {
			border-top: none;
		}

		.table>thead>tr>.no-line {
			border-bottom: none;
		}

		.table>tbody>tr>.no-line {
			border-top: 2px solid;
		}

		.red-text {
			color: red !important;
		}

		@media print {
			h1 {
				font-family: "Britannic Bold", Broadway, Calibri, sans-serif;
			}

			p {
				font-size: 10pt;
				font-family: "Calibri", serif;
			}

			.red-text {
				color: red !important;
			}

			.print-title {
				font-size: 12pt;
			}

			.print-thead {
				font-size: 10pt;
			}

			.print-text-tiny {
				font-size: 7pt;
			}

			.noprint {
				display: none;
			}
		}
	</style>

	<script language="javascript" type="text/javascript">
		window.print();

		function windowClose() {
			window.open('', '_parent', '');
			window.close();
		}
	</script>
</head>