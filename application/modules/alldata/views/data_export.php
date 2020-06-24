<html>
<head>
	<style>


		td.bd_color{width:310px; background-color:#F64747;}
		td.sd_color{ width:310px; background-color:#00FAFF;}
		table{font-size:8pt;font-family:Georgia;}

		th.title{line-height:2px;font-weight:bold;border-bottom:black solid 1pt; }

		table#wrap td.first{}
		table#wrap td.value{}

		table#s td.first{width:110px;border-left: black solid 1pt;line-height:2px;}
		table#s td.value{font-family:courier;width:60px;border-left: black solid 1pt;text-align:right;}
		table#title{font-size: 10pt;font-family:Courier;line-height: 3px;width:80%;}
		

		table th.headSummary{background-color: #47bb8e;}

		table#head{line-height:2px;font-family:calibri;}
		table#head td{}
		table#head td.first{font-weight:bold;border-top: black solid 1pt;text-align:left;width:45px;}
		table#head th.first{font-weight:bold;border-top: black solid 1pt;border-bottom: black solid 1pt;text-align:left;text-align:center;}
		table#head td.align-center{text-align:center;}
		table#head td.align-left{text-align:left;}
		table#head td.align-right{text-align:right;}

		table#head td.value{font-family:courier;text-align:center;border-right: black solid 1pt;width:55px;}
		table#head th{font-weight:bold;font-size:10pt;text-align:center;}
		span.jalan{font-size:8pt;font-weight:bold;}

		td.info{border-left: black solid 1pt;border-right: black solid 1pt;}

		table#s1 td.first{width:60pt;text-align:right;}
		table#s2 td.first{width:175pt;text-align:right;}

		table#footer td.val{font-family:courier}
		.bl{border-left:1pt solid #000;}
		.br{border-right:1pt solid #000;}
		.bt{border-top:1pt solid #000;}
		.bb{border-bottom:1pt solid #000;}

		.align-center{
		text-align:center;
		}
		.align-right{
		text-align:right;
		}
		.align-left{
		text-align:left;
		}
	</style>
</head>
<body>

	<?php $tanggal = date("d/m/Y");
			$header_stat="Content-Disposition: attachment; filename=Data-Besar.xls";
			header("Content-type: application/octet-stream");
			header($header_stat);
			header("Pragma: no-cache");
			header("Expires: 0");
	?>
	<div class="align-right">Date : <?php echo date('l\, jS F Y'); ?></div>
	<div>
		<div class="align-center">
		



		<h3>DATA BESAR TKW</h3>
		</div>
		<table border="1">
        <thead>
        <tr>
          <th style=" white-space:nowrap;">No</th>
          <th style=" white-space:nowrap;">Nama</th>
          <th style=" white-space:nowrap;">Tempat, Tgl Lahir</th>
          <th style=" white-space:nowrap;">Telp</th>
          <th style=" white-space:nowrap;">Tujuan</th>
          <th style=" white-space:nowrap;">Sponsor</th>
          <th style=" white-space:nowrap;">Agen</th>
          <th style=" white-space:nowrap;">Tgl Medical</th>
          <th style=" white-space:nowrap;">Hasil Medical</th>
          <th style=" white-space:nowrap;">Tgl Pengajuan Paspor</th>
          <th style=" white-space:nowrap;">Tgl Buat Paspor</th>
          <th style=" white-space:nowrap;">Tgl Expires Paspor</th>
          <th style=" white-space:nowrap;">Tgl Penyerahan Paspor</th>
          <th style=" white-space:nowrap;">No Passpor</th>
          <th style=" white-space:nowrap;">Tgl Panggilan Sidik Jari</th>
          <th style=" white-space:nowrap;">Tgl Sidik Jari</th>
          <th style=" white-space:nowrap;">Tgl Penyerahan Stempel Kedutaan</th>
          <th style=" white-space:nowrap;">Tgl Terbang</th>
          <th style=" white-space:nowrap;">Penerbangan Dari Kota</th>
          
        </tr>
        </thead>
        <tbody>
          <?php $i=0; foreach($data as $row) { $i++; ?>
          <tr>
            <td style=" white-space:nowrap;"><?php ++$i; ?></td>
            <td style=" white-space:nowrap;"><?php echo $row->name; ?></td>
            <td style=" white-space:nowrap;"><?php echo $row->pob; ?>, <?php echo $row->dob; ?></td>
            <td style=" white-space:nowrap;"><?php echo $row->phone; ?></td>
            <td style=" white-space:nowrap;"><?php echo $row->countryname; ?></td>
            <td style=" white-space:nowrap;"><?php echo $row->sponsorname; ?></td>
            <td style=" white-space:nowrap;"><?php echo $row->agen; ?></td>
            <td style=" white-space:nowrap;"><?php echo $row->tgl_medical; ?></td>
            <td style=" white-space:nowrap;"><?php echo $row->medical; ?></td>
            <td style=" white-space:nowrap;"><?php echo $row->tgl_pengajuan; ?></td>
            <td style=" white-space:nowrap;"><?php echo $row->tgl_buat; ?></td>
            <td style=" white-space:nowrap;"><?php echo $row->tgl_expired; ?></td>
            <td style=" white-space:nowrap;"><?php echo $row->tgl_serah; ?></td>
            <td style=" white-space:nowrap;"><?php echo $row->no_paspor; ?></td>
            <td style=" white-space:nowrap;"><?php echo $row->tgl_psj; ?></td>
            <td style=" white-space:nowrap;"><?php echo $row->tgl_sidikjari; ?></td>
            <td style=" white-space:nowrap;"><?php echo $row->tgl_stempel; ?></td>
            <td style=" white-space:nowrap;"><?php echo $row->tgl_terbang; ?></td>
            <td style=" white-space:nowrap;"><?php echo $row->call_from; ?></td>
          </tr>
          <?php } ?>
        </tbody>
       
      </table>
		<br/>
	</div>
	


</body>