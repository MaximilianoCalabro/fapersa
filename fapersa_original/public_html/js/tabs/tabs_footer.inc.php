<script type="text/javascript">
<?
foreach ($tabs AS $key => $value) {
?>
$('<?=$value?>').tabs(<?=$tabs_extras[$key]?>);
<?
}
?>
</script>
