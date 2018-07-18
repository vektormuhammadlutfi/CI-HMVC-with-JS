<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('tgl_indo'))
{
	function tgl_indo($tgl)
	{
		$ubah = gmdate($tgl, time()+60*60*8);
		$pecah = explode("-",$ubah);
		$tanggal = $pecah[2];
		$bulan = bulan($pecah[1]);
		$tahun = $pecah[0];
		return $tanggal.' '.$bulan.' '.$tahun;
	}
}

if ( ! function_exists('bulan'))
{
	function bulan($bln)
	{
		switch ($bln)
		{
			case 1:
				return "Januari";
				break;
			case 2:
				return "Februari";
				break;
			case 3:
				return "Maret";
				break;
			case 4:
				return "April";
				break;
			case 5:
				return "Mei";
				break;
			case 6:
				return "Juni";
				break;
			case 7:
				return "Juli";
				break;
			case 8:
				return "Agustus";
				break;
			case 9:
				return "September";
				break;
			case 10:
				return "Oktober";
				break;
			case 11:
				return "November";
				break;
			case 12:
				return "Desember";
				break;
		}
	}
}

if ( ! function_exists('nama_hari'))
{
	function nama_hari($tanggal)
	{
		$ubah = gmdate($tanggal, time()+60*60*8);
		$pecah = explode("-",$ubah);
		$tgl = $pecah[2];
		$bln = $pecah[1];
		$thn = $pecah[0];

		$nama = date("l", mktime(0,0,0,$bln,$tgl,$thn));
		$nama_hari = "";
		if($nama=="Sunday") {$nama_hari="Minggu";}
		else if($nama=="Monday") {$nama_hari="Senin";}
		else if($nama=="Tuesday") {$nama_hari="Selasa";}
		else if($nama=="Wednesday") {$nama_hari="Rabu";}
		else if($nama=="Thursday") {$nama_hari="Kamis";}
		else if($nama=="Friday") {$nama_hari="Jumat";}
		else if($nama=="Saturday") {$nama_hari="Sabtu";}
		return $nama_hari;
	}
}

if ( ! function_exists('hitung_mundur'))
{
	function hitung_mundur($wkt)
	{
		$waktu=array(	365*24*60*60	=> "tahun",
						30*24*60*60		=> "bulan",
						7*24*60*60		=> "minggu",
						24*60*60		=> "hari",
						60*60			=> "jam",
						60				=> "menit",
						1				=> "detik");

		$hitung = strtotime(gmdate ("Y-m-d H:i:s", time () +60 * 60 * 8))-$wkt;
		$hasil = array();
		if($hitung<5)
		{
			$hasil = 'kurang dari 5 detik yang lalu';
		}
		else
		{
			$stop = 0;
			foreach($waktu as $periode => $satuan)
			{
				if($stop>=6 || ($stop>0 && $periode<60)) break;
				$bagi = floor($hitung/$periode);
				if($bagi > 0)
				{
					$hasil[] = $bagi.' '.$satuan;
					$hitung -= $bagi*$periode;
					$stop++;
				}
				else if($stop>0) $stop++;
			}
			$hasil=implode(' ',$hasil).' yang lalu';
		}
		return $hasil;
	}
}

if ( ! function_exists('bulan_romawi'))
{
	function bulan_romawi($n)
	{
		$hasil = '';
		$iromawi = array('','I','II','III','IV','V','VI','VII','VIII','IX','X',20=>'XX',30=>'XXX',40=>'XL',50=>'L',
		60=>'LX',70=>'LXX',80=>'LXXX',90=>'XC',100=>'C',200=>'CC',300=>'CCC',400=>'CD',500=>'D',600=>'DC',700=>'DCC',
		800=>'DCCC',900=>'CM',1000=>'M',2000=>'MM',3000=>'MMM');
		if(array_key_exists($n,$iromawi)){
		$hasil = $iromawi[$n];
		}elseif($n >= 11 && $n <= 99){
		$i = $n % 10;
		$hasil = $iromawi[$n-$i] . Romawi($n % 10);
		}elseif($n >= 101 && $n <= 999){
		$i = $n % 100;
		$hasil = $iromawi[$n-$i] . Romawi($n % 100);
		}else{
		$i = $n % 1000;
		$hasil = $iromawi[$n-$i] . Romawi($n % 1000);
		}
		return $hasil;
	}
}

/**
 * Terbilang Helper
 *
 * @package	CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author	Gede Lumbung
 * @link	http://gedelumbung.com
 */

if ( ! function_exists('number_to_words'))
{
	function number_to_words($number)
	{
		$before_comma = trim(to_word($number));
		$after_comma = trim(comma($number));
		// return ucwords($results = $before_comma.' koma '.$after_comma);
		return ucwords($results = $before_comma.' Rupiah ');
	}

	function to_word($number)
	{
		$words = "";
		$arr_number = array(
		"",
		"satu",
		"dua",
		"tiga",
		"empat",
		"lima",
		"enam",
		"tujuh",
		"delapan",
		"sembilan",
		"sepuluh",
		"sebelas");

		if($number<12)
		{
			@$words = " ".$arr_number[$number];
		}
		else if($number<20)
		{
			$words = to_word($number-10)." belas";
		}
		else if($number<100)
		{
			$words = to_word($number/10)." puluh ".to_word($number%10);
		}
		else if($number<200)
		{
			$words = "seratus ".to_word($number-100);
		}
		else if($number<1000)
		{
			$words = to_word($number/100)." ratus ".to_word($number%100);
		}
		else if($number<2000)
		{
			$words = "seribu ".to_word($number-1000);
		}
		else if($number<1000000)
		{
			$words = to_word($number/1000)." ribu ".to_word($number%1000);
		}
		else if($number<1000000000)
		{
			$words = to_word($number/1000000)." juta ".to_word($number%1000000);
		}
		else
		{
			$words = "undefined";
		}
		return $words;
	}

	function comma($number)
	{
		$after_comma = stristr($number,',');
		$arr_number = array(
		"nol",
		"satu",
		"dua",
		"tiga",
		"empat",
		"lima",
		"enam",
		"tujuh",
		"delapan",
		"sembilan");

		$results = "";
		$length = strlen($after_comma);
		$i = 1;
		while($i<$length)
		{
			$get = substr($after_comma,$i,1);
			$results .= " ".$arr_number[$get];
			$i++;
		}
		return $results;
	}
}


if ( ! function_exists('hitung_umur'))
{
	function hitung_umur($tanggal_lahir) {
		list($year,$month,$day) = explode("-",$tanggal_lahir);
		$year_diff  = date("Y") - $year;
		$month_diff = date("m") - $month;
		$day_diff   = date("d") - $day;
		if ($month_diff < 0) $year_diff--;
			elseif (($month_diff==0) && ($day_diff < 0)) $year_diff--;
		return $year_diff;
	}
}

if( ! function_exists('selisih_jam'))
{
	function selisih_jam($tgl_jam_start, $tgl_jam_end){

		$datetime1 = new DateTime($tgl_jam_start);
		$datetime2 = new DateTime($tgl_jam_end);
		$interval = $datetime1->diff($datetime2);
		$jam = $interval->format('%h'); 
		$menit = $interval->format('%i'); 

		if( $menit >= 30 ) { 
			$jam_final = $jam+1;
		}else{
			$jam_final = $jam;
		}

		// die(print_r( $interval->format('%h')." Hours ".$interval->format('%i')." Minutes"));

		return $jam_final;
		
	}
}

if( ! function_exists('selisih_hari'))
{
	function selisih_hari($tglA,$tglB)
	{
		$tgl1 = $tglA;
		$tgl2 = $tglB;
		
		// memecah tanggal untuk mendapatkan bagian tanggal, bulan dan tahun
		// dari tanggal pertama
		
		$pecah1 = explode("-", $tgl1);
		$date1 = $pecah1[2];
		$month1 = $pecah1[1];
		$year1 = $pecah1[0];
		
		// memecah tanggal untuk mendapatkan bagian tanggal, bulan dan tahun
		// dari tanggal kedua
		
		$pecah2 = explode("-", $tgl2);
		$date2 = $pecah2[2];
		$month2 = $pecah2[1];
		$year2 =  $pecah2[0];
		
		// menghitung JDN dari masing-masing tanggal
		
		$jd1 = GregorianToJD($month1, $date1, $year1);
		$jd2 = GregorianToJD($month2, $date2, $year2);
		
		// hitung selisih hari kedua tanggal
		
		$selisih = $jd2 - $jd1;
		
		return $selisih;
	}
}
