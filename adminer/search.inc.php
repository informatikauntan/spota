<?php
class searching
{
	var $action;
	var $perintah;
	var $option = array();
	var $submit = "Search";
	var $bersih = "Clear";
	var $keyword;
	var $gambar = "../images/search.gif";
	var $field;
	var $jumop = 0;
	
	function __construct($action,$keyword,$submit)
	{
		$this->action = $action;
		$this->submit = $submit;
		$this->keyword = $keyword;
	}
	
	function tamsearchform()
	{
		echo "<form action= '".$this->action."' method='POST' >";
		echo "<table width='275' border='0' align='center'>";
		echo "<tr><td colspan='2'><img src='".$this->gambar."'></td></tr>";
		echo "<tr>
				<td align='right' width='50%'>
				<select name='".$this->field."'>
					<option value='0'>--SELECT--</option>
					<option value='NIM'>NIM</option>
					<option value='Judul'>Judul</option>
				</select>
				</td>";
		echo "<td width='50%'><input type='text' name='key'></td>
			  </tr>";
		echo "<tr>
				<td align='right'><input type='submit' value='".$this->submit."' ></td>
				<td><input type='reset' value='".$this->bersih."'></td>	
			 </tr></table></form>";	 
	}
	
	//function addoption($isi)
	//{
		//$this->option [$this->jumop]['kat'] = $isi;
		//$this->jumop ++;
	//}
}
?>