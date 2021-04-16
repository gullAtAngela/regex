<?php
include_once 'classes/Regex.php';
error_reporting(E_ALL);
ini_set('display_errors', '1');
$regex = new Regex();
if (isset($_POST['generate'])) {
	$regex->run();
}
$pageTitle = "Artikelnummern zählen";
include_once '../_template/head.php';
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
	function copyToClipboard(element) {
		var text = $(element).clone().find('br').prepend('\r\n').end().text()
		element = $('<textarea>').appendTo('body').val(text).select()
		document.execCommand('copy')
		element.remove()
	}
</script>
<body>
<div class="container">
	<?php include_once '../_template/header.php'; ?>
	<div class="row">
		<div class="col-sm-12 col-md-8">
			<h1><?= $pageTitle ?></h1>
			<h4>Beschreibung:</h4>
			<p>Kopiere im unteren Feld das Manus rein und lass dir die Artikelnummern auflisten. Danach kannst du die ganze Liste kopieren und damit weiterarbeiten.</p>
		</div>
		<div class="col-sm-12 mb-3">
			<form method="POST">
				<div class="row mb-3">
					<div class="col-sm-12">
						<label class="form-label" for="manus">Manus Text</label>
						<textarea class="form-control" name="manus" id="manus" rows="20"><?php echo (isset($_POST['manus'])) ? $_POST['manus'] : ""; ?></textarea>
					</div>
				</div>
				<div class="row justify-content-end">
					<div class="col-sm-2">
						<input class="form-control btn btn-primary" type="submit" name="generate" value="filtern">
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="row mb-3">
		<div class="col-sm-10">
			<?php
			if (isset($_POST['generate'])) {
				echo "<p><strong>Anzahl der gefundenen Artikelnummern:</strong> " . $regex->countMatches() . "<br>";
			}
			?>
		</div>
		<div class="col-sm-2 text-end">
			<button class="btn btn-secondary" onclick="copyToClipboard('#list')">Art. Liste kopieren</button>
		</div>
	</div>
	<div class="row mb-5">
		<div class="col-sm-12">
			<div id="list">
				<?php
				if (isset($_POST['generate'])) {
					echo $regex->showResult();
				}
				?>
			</div>
		</div>
	</div>
</div>
<?php include '../_template/footer.php'; ?>