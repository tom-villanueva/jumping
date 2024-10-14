<?php

namespace Database\Seeders;

use App\Models\Articulo;
use App\Models\Marca;
use App\Models\Modelo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class Articulos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // // db truncate
        // disable fk check
        Articulo::truncate();

        $articulos = [
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54514082",
                "codigo" => "0002",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54514077",
                "codigo" => "0003",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54514084",
                "codigo" => "0004",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54514075",
                "codigo" => "0005",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54514320",
                "codigo" => "0006",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54514065",
                "codigo" => "0007",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54514066",
                "codigo" => "0008",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54514064",
                "codigo" => "0009",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54514067",
                "codigo" => "0010",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54514318",
                "codigo" => "0011",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54514074",
                "codigo" => "0012",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54514319",
                "codigo" => "0013",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54514316",
                "codigo" => "0014",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54514080",
                "codigo" => "0015",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54912640",
                "codigo" => "0016",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54514076",
                "codigo" => "0017",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54514081",
                "codigo" => "0018",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54912644",
                "codigo" => "0019",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54514069",
                "codigo" => "0020",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54514078",
                "codigo" => "0021",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610980",
                "codigo" => "0022",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610981",
                "codigo" => "0023",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610985",
                "codigo" => "0024",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610955",
                "codigo" => "0025",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610999",
                "codigo" => "0026",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610983",
                "codigo" => "0027",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54611000",
                "codigo" => "0028",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610976",
                "codigo" => "0029",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54611001",
                "codigo" => "0030",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610966",
                "codigo" => "0031",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610998",
                "codigo" => "0032",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610987",
                "codigo" => "0033",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610962",
                "codigo" => "0034",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610993",
                "codigo" => "0035",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610977",
                "codigo" => "0036",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610978",
                "codigo" => "0037",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610963",
                "codigo" => "0038",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610957",
                "codigo" => "0039",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610996",
                "codigo" => "0040",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610984",
                "codigo" => "0041",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610954",
                "codigo" => "0042",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610956",
                "codigo" => "0043",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610790",
                "codigo" => "0044",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610698",
                "codigo" => "0045",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610695",
                "codigo" => "0046",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610691",
                "codigo" => "0047",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610703",
                "codigo" => "0048",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610788",
                "codigo" => "0049",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610712",
                "codigo" => "0050",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610702",
                "codigo" => "0051",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610694",
                "codigo" => "0052",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610689",
                "codigo" => "0053",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610786",
                "codigo" => "0054",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610701",
                "codigo" => "0055",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610718",
                "codigo" => "0056",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610697",
                "codigo" => "0057",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610690",
                "codigo" => "0058",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610720",
                "codigo" => "0059",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610713",
                "codigo" => "0060",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610692",
                "codigo" => "0061",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610789",
                "codigo" => "0062",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610688",
                "codigo" => "0063",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610714",
                "codigo" => "0064",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610699",
                "codigo" => "0065",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610785",
                "codigo" => "0066",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610787",
                "codigo" => "0068",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610687",
                "codigo" => "0069",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54610700",
                "codigo" => "0070",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54611376",
                "codigo" => "0071",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54611359",
                "codigo" => "0072",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54611346",
                "codigo" => "0073",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54611349",
                "codigo" => "0074",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54611348",
                "codigo" => "0075",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54611361",
                "codigo" => "0076",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54611358",
                "codigo" => "0077",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54611360",
                "codigo" => "0078",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54611371",
                "codigo" => "0079",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54611375",
                "codigo" => "0080",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54611374",
                "codigo" => "0081",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "54611370",
                "codigo" => "0082",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "43714194",
                "codigo" => "0083",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "43714233",
                "codigo" => "0084",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "43714223",
                "codigo" => "0085",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "43714221",
                "codigo" => "0086",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "43714222",
                "codigo" => "0087",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "43714199",
                "codigo" => "0088",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "43714217",
                "codigo" => "0089",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "43714238",
                "codigo" => "0090",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "43714218",
                "codigo" => "0091",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "43714190",
                "codigo" => "0092",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "43714237",
                "codigo" => "0093",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "43714236",
                "codigo" => "0094",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "43714229",
                "codigo" => "0095",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "43714235",
                "codigo" => "0096",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "43612171",
                "codigo" => "0097",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "44311398",
                "codigo" => "0099",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "44311375",
                "codigo" => "0100",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "44311380",
                "codigo" => "0102",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "44311370",
                "codigo" => "0103",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "44311397",
                "codigo" => "0104",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "43612201",
                "codigo" => "0105",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "43612199",
                "codigo" => "0106",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "44311396",
                "codigo" => "0107",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "43612170",
                "codigo" => "0108",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "43612190",
                "codigo" => "0109",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "44311359",
                "codigo" => "0110",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "44311382",
                "codigo" => "0111",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "43612195",
                "codigo" => "0112",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "44311364",
                "codigo" => "0113",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "44311381",
                "codigo" => "0114",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "44311378",
                "codigo" => "0115",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "44311369",
                "codigo" => "0116",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "44311390",
                "codigo" => "0117",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "44311366",
                "codigo" => "0118",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "44311374",
                "codigo" => "0119",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "44311376",
                "codigo" => "0120",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "44311358",
                "codigo" => "0121",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "44311344",
                "codigo" => "0122",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "44311393",
                "codigo" => "0123",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "44311352",
                "codigo" => "0124",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "44311387",
                "codigo" => "0125",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "43011240",
                "codigo" => "0126",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "42913518",
                "codigo" => "0127",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "42913510",
                "codigo" => "0128",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "42913503",
                "codigo" => "0129",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "42913506",
                "codigo" => "0130",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "42913501",
                "codigo" => "0132",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "42913488",
                "codigo" => "0133",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "42913483",
                "codigo" => "0134",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "42913485",
                "codigo" => "0135",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "42913487",
                "codigo" => "0136",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "42913489",
                "codigo" => "0137",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "42913490",
                "codigo" => "0138",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "42913515",
                "codigo" => "0139",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "42913502",
                "codigo" => "0140",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "42913516",
                "codigo" => "0141",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54510059",
                "codigo" => "0142",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54510062",
                "codigo" => "0143",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54510075",
                "codigo" => "0144",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54510061",
                "codigo" => "0145",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54510060",
                "codigo" => "0146",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54510105",
                "codigo" => "0147",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54014005",
                "codigo" => "0148",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54610358",
                "codigo" => "0149",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54014025",
                "codigo" => "0150",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54014083",
                "codigo" => "0151",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54610325",
                "codigo" => "0152",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54014027",
                "codigo" => "0153",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54610356",
                "codigo" => "0154",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54610361",
                "codigo" => "0155",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54610357",
                "codigo" => "0156",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54014041",
                "codigo" => "0157",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54610368",
                "codigo" => "0158",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54014040",
                "codigo" => "0159",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54610352",
                "codigo" => "0160",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54610355",
                "codigo" => "0161",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54610350",
                "codigo" => "0162",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54610353",
                "codigo" => "0164",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54610360",
                "codigo" => "0165",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54014039",
                "codigo" => "0166",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54610367",
                "codigo" => "0167",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54610362",
                "codigo" => "0168",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54610345",
                "codigo" => "0169",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54610354",
                "codigo" => "0170",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54610365",
                "codigo" => "0171",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54610364",
                "codigo" => "0172",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54610359",
                "codigo" => "0173",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54014024",
                "codigo" => "0174",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54013997",
                "codigo" => "0175",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54610344",
                "codigo" => "0176",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54013996",
                "codigo" => "0177",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54510844",
                "codigo" => "0178",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54510837",
                "codigo" => "0179",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54511084",
                "codigo" => "0180",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54510874",
                "codigo" => "0181",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54511085",
                "codigo" => "0182",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54510841",
                "codigo" => "0183",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54510838",
                "codigo" => "0184",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54510852",
                "codigo" => "0185",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54511082",
                "codigo" => "0186",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54511081",
                "codigo" => "0187",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54511086",
                "codigo" => "0188",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54510851",
                "codigo" => "0189",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR",
                "nro_serie" => "54612265",
                "codigo" => "0190",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA 75",
                "nro_serie" => "53914376",
                "codigo" => "0191",
                "talle_id" => 14,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA 75",
                "nro_serie" => "53915364",
                "codigo" => "0193",
                "talle_id" => 13,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA 75",
                "nro_serie" => "53915370",
                "codigo" => "0194",
                "talle_id" => 13,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA 75",
                "nro_serie" => "53915353",
                "codigo" => "0195",
                "talle_id" => 13,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA 75",
                "nro_serie" => "53915367",
                "codigo" => "0196",
                "talle_id" => 13,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA 75",
                "nro_serie" => "53915360",
                "codigo" => "0197",
                "talle_id" => 13,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA 75",
                "nro_serie" => "53915356",
                "codigo" => "0198",
                "talle_id" => 13,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA 75",
                "nro_serie" => "54010053",
                "codigo" => "0199",
                "talle_id" => 10,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA 75",
                "nro_serie" => "54010062",
                "codigo" => "0200",
                "talle_id" => 10,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA 75",
                "nro_serie" => "54010175",
                "codigo" => "0201",
                "talle_id" => 10,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA 75",
                "nro_serie" => "54010061",
                "codigo" => "0202",
                "talle_id" => 10,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA 75",
                "nro_serie" => "54010055",
                "codigo" => "0203",
                "talle_id" => 10,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA 75",
                "nro_serie" => "54010174",
                "codigo" => "0204",
                "talle_id" => 10,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA 75",
                "nro_serie" => "54010181",
                "codigo" => "0205",
                "talle_id" => 10,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA 75",
                "nro_serie" => "54010180",
                "codigo" => "0206",
                "talle_id" => 10,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA 75",
                "nro_serie" => "54010054",
                "codigo" => "0207",
                "talle_id" => 10,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA 75",
                "nro_serie" => "54010176",
                "codigo" => "0208",
                "talle_id" => 10,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA 75",
                "nro_serie" => "54010052",
                "codigo" => "0209",
                "talle_id" => 10,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA 75",
                "nro_serie" => "54010050",
                "codigo" => "0210",
                "talle_id" => 10,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA 75",
                "nro_serie" => "54010358",
                "codigo" => "0211",
                "talle_id" => 10,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA 75",
                "nro_serie" => "54010359",
                "codigo" => "0212",
                "talle_id" => 10,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA 75",
                "nro_serie" => "54010059",
                "codigo" => "0213",
                "talle_id" => 10,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA 75",
                "nro_serie" => "54010172",
                "codigo" => "0214",
                "talle_id" => 10,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA 75",
                "nro_serie" => "54010060",
                "codigo" => "0215",
                "talle_id" => 10,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA 75",
                "nro_serie" => "54010064",
                "codigo" => "0216",
                "talle_id" => 10,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA 75",
                "nro_serie" => "54010183",
                "codigo" => "0217",
                "talle_id" => 10,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA 75",
                "nro_serie" => "54010058",
                "codigo" => "0219",
                "talle_id" => 10,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA 75",
                "nro_serie" => "54010056",
                "codigo" => "0220",
                "talle_id" => 10,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA 75",
                "nro_serie" => "54010051",
                "codigo" => "0221",
                "talle_id" => 10,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE76 XTR",
                "nro_serie" => "54513501",
                "codigo" => "0222",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE76 XTR",
                "nro_serie" => "54513497",
                "codigo" => "0223",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE76 XTR",
                "nro_serie" => "54513510",
                "codigo" => "0224",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE76 XTR",
                "nro_serie" => "54513496",
                "codigo" => "0225",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE76 XTR",
                "nro_serie" => "54513503",
                "codigo" => "0226",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE76 XTR",
                "nro_serie" => "54513494",
                "codigo" => "0227",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE76 XTR",
                "nro_serie" => "54513505",
                "codigo" => "0228",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE76 XTR",
                "nro_serie" => "54513518",
                "codigo" => "0229",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE76 XTR",
                "nro_serie" => "54513502",
                "codigo" => "0230",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "PRODIGY",
                "nro_serie" => "44514068",
                "codigo" => "0231",
                "talle_id" => 10,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "PRODIGY",
                "nro_serie" => "70812971",
                "codigo" => "0232",
                "talle_id" => 10,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "PRODIGY",
                "nro_serie" => "44514067",
                "codigo" => "0233",
                "talle_id" => 10,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "PRODIGY",
                "nro_serie" => "44514220",
                "codigo" => "0234",
                "talle_id" => 10,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "PRODIGY",
                "nro_serie" => "70812973",
                "codigo" => "0235",
                "talle_id" => 10,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "PRODIGY",
                "nro_serie" => "44514066",
                "codigo" => "0236",
                "talle_id" => 10,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "PRODIGY",
                "nro_serie" => "64311885",
                "codigo" => "0237",
                "talle_id" => 10,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "PRODIGY",
                "nro_serie" => "70812974",
                "codigo" => "0238",
                "talle_id" => 10,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "C-LINE EMPEROR",
                "nro_serie" => "51910587",
                "codigo" => "0239",
                "talle_id" => 26,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "C-LINE EMPEROR",
                "nro_serie" => "51710023",
                "codigo" => "0240",
                "talle_id" => 26,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "C-LINE TRIBUNE",
                "nro_serie" => "43512655",
                "codigo" => "0241",
                "talle_id" => 26,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "PROGRESSOR WOODCORE",
                "nro_serie" => "52513098",
                "codigo" => "0242",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RACE",
                "nro_serie" => "513012",
                "codigo" => "0246",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RACE",
                "nro_serie" => "313308",
                "codigo" => "0247",
                "talle_id" => 21,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RACE",
                "nro_serie" => "313302",
                "codigo" => "0248",
                "talle_id" => 21,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RACE",
                "nro_serie" => "313300",
                "codigo" => "0250",
                "talle_id" => 21,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR PRO MT X",
                "nro_serie" => "84915713",
                "codigo" => "0251",
                "talle_id" => 9,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR PRO MT X",
                "nro_serie" => "84915716",
                "codigo" => "0252",
                "talle_id" => 9,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR PRO MT X",
                "nro_serie" => "84915715",
                "codigo" => "0253",
                "talle_id" => 9,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR PRO MT X",
                "nro_serie" => "84915717",
                "codigo" => "0254",
                "talle_id" => 9,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR PRO MT X",
                "nro_serie" => "84913537",
                "codigo" => "0255",
                "talle_id" => 10,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR PRO MT X",
                "nro_serie" => "85010053",
                "codigo" => "0256",
                "talle_id" => 17,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR PRO MT X",
                "nro_serie" => "84814558",
                "codigo" => "0257",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR PRO MT X",
                "nro_serie" => "84814559",
                "codigo" => "0258",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR PRO MT X",
                "nro_serie" => "84814540",
                "codigo" => "0259",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR PRO MT X",
                "nro_serie" => "84814561",
                "codigo" => "0260",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR PRO MT X",
                "nro_serie" => "84814534",
                "codigo" => "0261",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR PRO MT X",
                "nro_serie" => "84814536",
                "codigo" => "0262",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR PRO MT X",
                "nro_serie" => "84814538",
                "codigo" => "0263",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR PRO MT X",
                "nro_serie" => "84814543",
                "codigo" => "0264",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR PRO MT X",
                "nro_serie" => "84814560",
                "codigo" => "0265",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR PRO MT X",
                "nro_serie" => "84814541",
                "codigo" => "0266",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR PRO MT X",
                "nro_serie" => "84814563",
                "codigo" => "0267",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR PRO MT X",
                "nro_serie" => "84814546",
                "codigo" => "0268",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR PRO MT X",
                "nro_serie" => "84814544",
                "codigo" => "0269",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR PRO MT X",
                "nro_serie" => "84814537",
                "codigo" => "0270",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR PRO MT X",
                "nro_serie" => "84814551",
                "codigo" => "0271",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR PRO MT X",
                "nro_serie" => "83912990",
                "codigo" => "0273",
                "talle_id" => 21,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR PRO MT X",
                "nro_serie" => "83912986",
                "codigo" => "0274",
                "talle_id" => 21,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR PRO MT X",
                "nro_serie" => "83912985",
                "codigo" => "0276",
                "talle_id" => 21,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR PRO MT X",
                "nro_serie" => "83912987",
                "codigo" => "0277",
                "talle_id" => 21,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR PRO MT X",
                "nro_serie" => "83912989",
                "codigo" => "0278",
                "talle_id" => 21,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MY MTN 80",
                "nro_serie" => "74313202",
                "codigo" => "0279",
                "talle_id" => 13,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MY MTN 80",
                "nro_serie" => "74313199",
                "codigo" => "0280",
                "talle_id" => 13,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MY MTN 80",
                "nro_serie" => "74313201",
                "codigo" => "0281",
                "talle_id" => 13,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MY MTN 80",
                "nro_serie" => "74313203",
                "codigo" => "0282",
                "talle_id" => 13,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MY MTN 80",
                "nro_serie" => "74313204",
                "codigo" => "0283",
                "talle_id" => 13,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MY MTN 80",
                "nro_serie" => "72311273",
                "codigo" => "0284",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MY MTN 80",
                "nro_serie" => "72311282",
                "codigo" => "0285",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MY MTN 80",
                "nro_serie" => "72311276",
                "codigo" => "0286",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MY XTR 77",
                "nro_serie" => "84615178",
                "codigo" => "0287",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "PROGRESSOR F16",
                "nro_serie" => "45112467",
                "codigo" => "0288",
                "talle_id" => 21,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "PROGRESSOR F16",
                "nro_serie" => "45113101",
                "codigo" => "0290",
                "talle_id" => 21,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "PROGRESSOR F16",
                "nro_serie" => "45113098",
                "codigo" => "0289",
                "talle_id" => 21,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "PROGRESSOR F16",
                "nro_serie" => "45113099",
                "codigo" => "0291",
                "talle_id" => 21,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE 80 XTR NEGRO",
                "nro_serie" => "53510685",
                "codigo" => "0292",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE 80 XTR NEGRO",
                "nro_serie" => "53510679",
                "codigo" => "0294",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE 80 XTR NEGRO",
                "nro_serie" => "53510684",
                "codigo" => "0295",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE 80 XTR NEGRO",
                "nro_serie" => "53510714",
                "codigo" => "0296",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE 80 XTR NEGRO",
                "nro_serie" => "53510705",
                "codigo" => "0297",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE 80 XTR NEGRO",
                "nro_serie" => "53510681",
                "codigo" => "0298",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE 80 XTR NEGRO",
                "nro_serie" => "53510676",
                "codigo" => "0299",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE 80 XTR NEGRO",
                "nro_serie" => "53510715",
                "codigo" => "0300",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE 80 XTR NEGRO",
                "nro_serie" => "53510670",
                "codigo" => "0301",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE 80 XTR NEGRO",
                "nro_serie" => "53510674",
                "codigo" => "0302",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE 80 XTR NEGRO",
                "nro_serie" => "54410378",
                "codigo" => "0303",
                "talle_id" => 21,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE 80 XTR NEGRO",
                "nro_serie" => "54410373",
                "codigo" => "0304",
                "talle_id" => 21,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE 80 XTR NEGRO",
                "nro_serie" => "54410374",
                "codigo" => "0305",
                "talle_id" => 21,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE 80 XTR NEGRO",
                "nro_serie" => "54410376",
                "codigo" => "0306",
                "talle_id" => 21,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE 80 XTR NEGRO",
                "nro_serie" => "54410384",
                "codigo" => "0307",
                "talle_id" => 21,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE 80 XTR NEGRO",
                "nro_serie" => "54410375",
                "codigo" => "0308",
                "talle_id" => 21,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE 80 XTR NEGRO",
                "nro_serie" => "54313953",
                "codigo" => "0309",
                "talle_id" => 23,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE 80 XTR NEGRO",
                "nro_serie" => "54313951",
                "codigo" => "0310",
                "talle_id" => 23,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE 80 XTR NEGRO",
                "nro_serie" => "54313952",
                "codigo" => "0311",
                "talle_id" => 23,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE 80 XTR NEGRO",
                "nro_serie" => "54313984",
                "codigo" => "0312",
                "talle_id" => 23,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE 80 XTR NEGRO",
                "nro_serie" => "54313955",
                "codigo" => "0313",
                "talle_id" => 23,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE 80 XTR BLANCO",
                "nro_serie" => "45113028",
                "codigo" => "0314",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE 80 XTR BLANCO",
                "nro_serie" => "45210346",
                "codigo" => "0315",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE 80 XTR BLANCO",
                "nro_serie" => "45210362",
                "codigo" => "0316",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE 80 XTR BLANCO",
                "nro_serie" => "45210349",
                "codigo" => "0317",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE 80 XTR BLANCO",
                "nro_serie" => "45210345",
                "codigo" => "0318",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE 80 XTR BLANCO",
                "nro_serie" => "44810568",
                "codigo" => "0319",
                "talle_id" => 21,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE 80 XTR BLANCO",
                "nro_serie" => "44812495",
                "codigo" => "0320",
                "talle_id" => 21,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE 80 XTR BLANCO",
                "nro_serie" => "44810562",
                "codigo" => "0321",
                "talle_id" => 21,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE 80 XTR BLANCO",
                "nro_serie" => "44810564",
                "codigo" => "0322",
                "talle_id" => 21,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA 84",
                "nro_serie" => "44314362",
                "codigo" => "0323",
                "talle_id" => 13,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "WATEA",
                "nro_serie" => "05010296",
                "codigo" => "0324",
                "talle_id" => 23,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "PROGRESSOR 900",
                "nro_serie" => "53415203",
                "codigo" => "0325",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "PROGRESSOR 900",
                "nro_serie" => "53415187",
                "codigo" => "0326",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "PROGRESSOR 900",
                "nro_serie" => "53715966",
                "codigo" => "0327",
                "talle_id" => 18,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "PROGRESSOR 900",
                "nro_serie" => "53715947",
                "codigo" => "0328",
                "talle_id" => 18,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CURV XTR",
                "nro_serie" => "90220383",
                "codigo" => "0330",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CURV XTR",
                "nro_serie" => "90621574",
                "codigo" => "0331",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CURV XTR",
                "nro_serie" => "94620455",
                "codigo" => "0332",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CURV XTR",
                "nro_serie" => "94620453",
                "codigo" => "0333",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CURV XTR",
                "nro_serie" => "94620454",
                "codigo" => "0334",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CURV XTR",
                "nro_serie" => "94620440",
                "codigo" => "0335",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CURV XTR",
                "nro_serie" => "94620436",
                "codigo" => "0336",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CURV XTR",
                "nro_serie" => "94620435",
                "codigo" => "0337",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR PRO MT 80",
                "nro_serie" => "84715407",
                "codigo" => "0338",
                "talle_id" => 17,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR PRO MT 80",
                "nro_serie" => "84715405",
                "codigo" => "0339",
                "talle_id" => 17,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR PRO MT 80",
                "nro_serie" => "84715406",
                "codigo" => "0340",
                "talle_id" => 17,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR PRO MT 80",
                "nro_serie" => "84715664",
                "codigo" => "0342",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR PRO MT 80",
                "nro_serie" => "84715660",
                "codigo" => "0343",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR PRO MT 80",
                "nro_serie" => "84715665",
                "codigo" => "0344",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR PRO MT 80",
                "nro_serie" => "84715662",
                "codigo" => "0345",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR PRO MT 80",
                "nro_serie" => "84715661",
                "codigo" => "0346",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "PROGRESSOR XTR RED",
                "nro_serie" => "84813138",
                "codigo" => "0348",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "PROGRESSOR XTR RED",
                "nro_serie" => "84813133",
                "codigo" => "0349",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "PROGRESSOR XTR RED",
                "nro_serie" => "84813147",
                "codigo" => "0350",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "PROGRESSOR XTR RED",
                "nro_serie" => "84813431",
                "codigo" => "0351",
                "talle_id" => 21,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "PROGRESSOR XTR RED",
                "nro_serie" => "84813429",
                "codigo" => "0352",
                "talle_id" => 21,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "PROGRESSOR XTR RED",
                "nro_serie" => "84813430",
                "codigo" => "0353",
                "talle_id" => 21,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MY MTN 80",
                "nro_serie" => "74813459",
                "codigo" => "0354",
                "talle_id" => 10,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MY MTN 80",
                "nro_serie" => "74813465",
                "codigo" => "0355",
                "talle_id" => 10,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MY MTN 80",
                "nro_serie" => "74813463",
                "codigo" => "0356",
                "talle_id" => 10,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MY MTN 80",
                "nro_serie" => "74813464",
                "codigo" => "0357",
                "talle_id" => 10,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CURV XTR",
                "nro_serie" => "94620456",
                "codigo" => "0358",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CURV XTR",
                "nro_serie" => "94121986",
                "codigo" => "0359",
                "talle_id" => 21,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CURV XTR",
                "nro_serie" => "94121976",
                "codigo" => "0360",
                "talle_id" => 21,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CURV XTR",
                "nro_serie" => "94121977",
                "codigo" => "0361",
                "talle_id" => 21,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CURV XTR",
                "nro_serie" => "94121984",
                "codigo" => "0362",
                "talle_id" => 21,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CURV XTR",
                "nro_serie" => "94121983",
                "codigo" => "0363",
                "talle_id" => 21,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CURV XTR",
                "nro_serie" => "94121982",
                "codigo" => "0364",
                "talle_id" => 21,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CURV XTR",
                "nro_serie" => "94121973",
                "codigo" => "0365",
                "talle_id" => 21,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CURV XTR",
                "nro_serie" => "94121972",
                "codigo" => "0366",
                "talle_id" => 21,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "THE CURV XTR",
                "nro_serie" => "01722268",
                "codigo" => "0367",
                "talle_id" => 14,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "THE CURV XTR",
                "nro_serie" => "95020291",
                "codigo" => "0368",
                "talle_id" => 14,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "THE CURV XTR",
                "nro_serie" => "01722269",
                "codigo" => "0369",
                "talle_id" => 14,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "THE CURV XTR",
                "nro_serie" => "02220224",
                "codigo" => "0370",
                "talle_id" => 18,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "THE CURV XTR",
                "nro_serie" => "02220223",
                "codigo" => "0371",
                "talle_id" => 18,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "THE CURV XTR",
                "nro_serie" => "02220222",
                "codigo" => "0372",
                "talle_id" => 18,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "THE CURV XTR",
                "nro_serie" => "01920048",
                "codigo" => "0373",
                "talle_id" => 18,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "THE CURV XTR",
                "nro_serie" => "01920046",
                "codigo" => "0374",
                "talle_id" => 18,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "THE CURV XTR",
                "nro_serie" => "02220225",
                "codigo" => "0375",
                "talle_id" => 18,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR 73",
                "nro_serie" => "91420781",
                "codigo" => "0376",
                "talle_id" => 14,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR 73",
                "nro_serie" => "91420774",
                "codigo" => "0377",
                "talle_id" => 14,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR 73",
                "nro_serie" => "94122203",
                "codigo" => "0378",
                "talle_id" => 17,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR 73",
                "nro_serie" => "92620889",
                "codigo" => "0379",
                "talle_id" => 17,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR 73",
                "nro_serie" => "92621169",
                "codigo" => "0380",
                "talle_id" => 17,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR 73",
                "nro_serie" => "92690075",
                "codigo" => "0381",
                "talle_id" => 17,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR 73",
                "nro_serie" => "93820556",
                "codigo" => "0382",
                "talle_id" => 18,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR 73",
                "nro_serie" => "93820547",
                "codigo" => "0383",
                "talle_id" => 18,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR 77",
                "nro_serie" => "01211201",
                "codigo" => "0384",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR 77",
                "nro_serie" => "01211202",
                "codigo" => "0385",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR 77",
                "nro_serie" => "01211206",
                "codigo" => "0386",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR 77",
                "nro_serie" => "01011514",
                "codigo" => "0387",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR 77",
                "nro_serie" => "01211195",
                "codigo" => "0388",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR 77",
                "nro_serie" => "01010948",
                "codigo" => "0389",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR 77",
                "nro_serie" => "01211196",
                "codigo" => "0390",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR 77",
                "nro_serie" => "01010954",
                "codigo" => "0391",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR 77",
                "nro_serie" => "01211164",
                "codigo" => "0392",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR 77",
                "nro_serie" => "01010943",
                "codigo" => "0393",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR 77",
                "nro_serie" => "01011437",
                "codigo" => "0394",
                "talle_id" => 14,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR 77",
                "nro_serie" => "01011438",
                "codigo" => "0395",
                "talle_id" => 14,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR 77",
                "nro_serie" => "01011439",
                "codigo" => "0396",
                "talle_id" => 14,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR 77",
                "nro_serie" => "01011440",
                "codigo" => "0397",
                "talle_id" => 14,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR 77",
                "nro_serie" => "01011434",
                "codigo" => "0398",
                "talle_id" => 14,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR 77",
                "nro_serie" => "01011488",
                "codigo" => "0399",
                "talle_id" => 14,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR 77",
                "nro_serie" => "01011487",
                "codigo" => "0400",
                "talle_id" => 14,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR 77",
                "nro_serie" => "01011494",
                "codigo" => "0401",
                "talle_id" => 14,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR 77",
                "nro_serie" => "01011493",
                "codigo" => "0402",
                "talle_id" => 14,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR 77",
                "nro_serie" => "01011490",
                "codigo" => "0403",
                "talle_id" => 14,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR 77",
                "nro_serie" => "01011492",
                "codigo" => "0404",
                "talle_id" => 14,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR 77",
                "nro_serie" => "01010924",
                "codigo" => "0405",
                "talle_id" => 18,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR 77",
                "nro_serie" => "01010902",
                "codigo" => "0406",
                "talle_id" => 18,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR 77",
                "nro_serie" => "01010903",
                "codigo" => "0407",
                "talle_id" => 18,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR 77",
                "nro_serie" => "01010931",
                "codigo" => "0408",
                "talle_id" => 18,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR 77",
                "nro_serie" => "01010932",
                "codigo" => "0409",
                "talle_id" => 18,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR 77",
                "nro_serie" => "01010930",
                "codigo" => "0410",
                "talle_id" => 18,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR 77",
                "nro_serie" => "01010926",
                "codigo" => "0411",
                "talle_id" => 18,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR 77",
                "nro_serie" => "01010927",
                "codigo" => "0412",
                "talle_id" => 18,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR 77",
                "nro_serie" => "01013461",
                "codigo" => "0413",
                "talle_id" => 18,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR 77",
                "nro_serie" => "01010928",
                "codigo" => "0414",
                "talle_id" => 18,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RACE ONE JR",
                "nro_serie" => "94015043",
                "codigo" => "0415",
                "talle_id" => 57,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RACE ONE JR",
                "nro_serie" => "94015042",
                "codigo" => "0416",
                "talle_id" => 57,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RACE ONE JR",
                "nro_serie" => "941110952",
                "codigo" => "0418",
                "talle_id" => 7,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RACE ONE JR",
                "nro_serie" => "941110940",
                "codigo" => "0419",
                "talle_id" => 7,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CURV JR",
                "nro_serie" => "94415331",
                "codigo" => "0421",
                "talle_id" => 1,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CURV JR",
                "nro_serie" => "94415330",
                "codigo" => "0422",
                "talle_id" => 1,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CURV JR",
                "nro_serie" => "94415306",
                "codigo" => "0423",
                "talle_id" => 1,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA JR",
                "nro_serie" => "54311060",
                "codigo" => "0424",
                "talle_id" => 1,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CURV JR",
                "nro_serie" => "94415312",
                "codigo" => "0425",
                "talle_id" => 1,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA JR",
                "nro_serie" => "54311054",
                "codigo" => "0426",
                "talle_id" => 1,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA JR",
                "nro_serie" => "54311056",
                "codigo" => "0427",
                "talle_id" => 1,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA JR",
                "nro_serie" => "54311061",
                "codigo" => "0429",
                "talle_id" => 1,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA JR",
                "nro_serie" => "54412088",
                "codigo" => "0430",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA JR",
                "nro_serie" => "54412083",
                "codigo" => "0432",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA JR",
                "nro_serie" => "54412085",
                "codigo" => "0433",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA JR",
                "nro_serie" => "54412084",
                "codigo" => "0434",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA JR2",
                "nro_serie" => "34310991",
                "codigo" => "0435",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA JR2",
                "nro_serie" => "33615054",
                "codigo" => "0436",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RACE4 JR",
                "nro_serie" => "94115899",
                "codigo" => "0437",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RACE4 JR",
                "nro_serie" => "94115560",
                "codigo" => "0438",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RACE4 JR",
                "nro_serie" => "94115934",
                "codigo" => "0439",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RACE4 JR",
                "nro_serie" => "94115550",
                "codigo" => "0441",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RACE4 JR",
                "nro_serie" => "94115900",
                "codigo" => "0442",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RC4 JR",
                "nro_serie" => "54315132",
                "codigo" => "0443",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RC4 JR",
                "nro_serie" => "54314856",
                "codigo" => "0444",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RC4 JR",
                "nro_serie" => "54315130",
                "codigo" => "0445",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RC4 JR",
                "nro_serie" => "54314870",
                "codigo" => "0446",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RC4 JR",
                "nro_serie" => "54314857",
                "codigo" => "0447",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "STUNNER JR",
                "nro_serie" => "93814693",
                "codigo" => "0448",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "STUNNER JR",
                "nro_serie" => "93814695",
                "codigo" => "0449",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "STUNNER JR",
                "nro_serie" => "93814696",
                "codigo" => "0450",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "STUNNER JR",
                "nro_serie" => "93814692",
                "codigo" => "0451",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "STUNNER JR",
                "nro_serie" => "93814694",
                "codigo" => "0452",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "STUNNER JR",
                "nro_serie" => "54312411",
                "codigo" => "0453",
                "talle_id" => 7,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "STUNNER JR",
                "nro_serie" => "54312410",
                "codigo" => "0454",
                "talle_id" => 7,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "STUNNER JR",
                "nro_serie" => "54312423",
                "codigo" => "0455",
                "talle_id" => 7,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "STUNNER JR",
                "nro_serie" => "54312439",
                "codigo" => "0456",
                "talle_id" => 7,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "STUNNER JR",
                "nro_serie" => "54312438",
                "codigo" => "0457",
                "talle_id" => 7,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RACE JR",
                "nro_serie" => "53310956",
                "codigo" => "0458",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RACE JR",
                "nro_serie" => "53310979",
                "codigo" => "0459",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RACE JR",
                "nro_serie" => "53310943",
                "codigo" => "0460",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RACE JR",
                "nro_serie" => "53310980",
                "codigo" => "0461",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RACE JR",
                "nro_serie" => "53310983",
                "codigo" => "0462",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RACE JR",
                "nro_serie" => "53310957",
                "codigo" => "0463",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RACE JR",
                "nro_serie" => "53310984",
                "codigo" => "0464",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE JR",
                "nro_serie" => "53510066",
                "codigo" => "0465",
                "talle_id" => 7,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA 80",
                "nro_serie" => "54011784",
                "codigo" => "0466",
                "talle_id" => 17,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA 80",
                "nro_serie" => "54011786",
                "codigo" => "0467",
                "talle_id" => 17,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR SPEED XTR",
                "nro_serie" => "52213443",
                "codigo" => "0469",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR SPEED XTR",
                "nro_serie" => "52213451",
                "codigo" => "0470",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR SPEED XTR",
                "nro_serie" => "52213455",
                "codigo" => "0471",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR SPEED XTR",
                "nro_serie" => "52213450",
                "codigo" => "0472",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR SPEED XTR",
                "nro_serie" => "52213468",
                "codigo" => "0473",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR SPEED XTR",
                "nro_serie" => "52414360",
                "codigo" => "0474",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR SPEED XTR",
                "nro_serie" => "52414331",
                "codigo" => "0475",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR SPEED XTR",
                "nro_serie" => "52414329",
                "codigo" => "0476",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR SPEED XTR",
                "nro_serie" => "52414333",
                "codigo" => "0477",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR SPEED XTR",
                "nro_serie" => "52414171",
                "codigo" => "0478",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "RTX JR",
                "nro_serie" => "117687821",
                "codigo" => "0479",
                "talle_id" => 7,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "FIREBIRD JR",
                "nro_serie" => "118017329",
                "codigo" => "0480",
                "talle_id" => 55,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "FIREBIRD JR",
                "nro_serie" => "118017334",
                "codigo" => "0481",
                "talle_id" => 55,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "FIREBIRD JR",
                "nro_serie" => "120780117",
                "codigo" => "0484",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "FIREBIRD JR",
                "nro_serie" => "120077220",
                "codigo" => "0485",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "FIREBIRD JR",
                "nro_serie" => "120659311",
                "codigo" => "0486",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "VIVA JR",
                "nro_serie" => "112114427",
                "codigo" => "0487",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "VIVA JR",
                "nro_serie" => "112114421",
                "codigo" => "0488",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "VIVA JR",
                "nro_serie" => "112585455",
                "codigo" => "0489",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "VIVA JR",
                "nro_serie" => "112585448",
                "codigo" => "0490",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "POWER IQ JR",
                "nro_serie" => "115773055",
                "codigo" => "0491",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "POWER IQ JR",
                "nro_serie" => "115773058",
                "codigo" => "0492",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "FIREBIRD JR",
                "nro_serie" => "120618544",
                "codigo" => "0493",
                "talle_id" => 7,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "FIREBIRD JR",
                "nro_serie" => "120618548",
                "codigo" => "0494",
                "talle_id" => 7,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "FIREBIRD JR",
                "nro_serie" => "120618545",
                "codigo" => "0495",
                "talle_id" => 7,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "FIREBIRD JR",
                "nro_serie" => "119532980",
                "codigo" => "0499",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "FIREBIRD JR",
                "nro_serie" => "119531746",
                "codigo" => "0500",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "FIREBIRD JR",
                "nro_serie" => "119531756",
                "codigo" => "0501",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "FIREBIRD JR",
                "nro_serie" => "119532989",
                "codigo" => "0503",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "FIREBIRD JR",
                "nro_serie" => "119532990",
                "codigo" => "0505",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "FIREBIRD JR",
                "nro_serie" => "119531755",
                "codigo" => "0506",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "FIREBIRD JR",
                "nro_serie" => "119532979",
                "codigo" => "0507",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "FIREBIRD JR",
                "nro_serie" => "120589701",
                "codigo" => "0508",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "FIREBIRD JR",
                "nro_serie" => "120588724",
                "codigo" => "0509",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "FIREBIRD JR",
                "nro_serie" => "120588709",
                "codigo" => "0511",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "FIREBIRD JR",
                "nro_serie" => "120588698",
                "codigo" => "0512",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "MAGNIUM JR",
                "nro_serie" => "112694820",
                "codigo" => "0513",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "BURTON",
                "modelo" => "AZUL Y NARANJA",
                "nro_serie" => "168700925",
                "codigo" => "2001",
                "talle_id" => 9,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "VERDE Y VIOLETA",
                "nro_serie" => "175700261",
                "codigo" => "2002",
                "talle_id" => 10,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "VERDE Y VIOLETA",
                "nro_serie" => "175700252",
                "codigo" => "2003",
                "talle_id" => 10,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "VERDE Y VIOLETA",
                "nro_serie" => "175700036",
                "codigo" => "2004",
                "talle_id" => 10,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "VERDE Y VIOLETA",
                "nro_serie" => "175700266",
                "codigo" => "2005",
                "talle_id" => 10,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "VERDE Y VIOLETA",
                "nro_serie" => "175700214",
                "codigo" => "2006",
                "talle_id" => 10,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "VERDE Y VIOLETA",
                "nro_serie" => "175700010",
                "codigo" => "2007",
                "talle_id" => 10,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "VERDE Y VIOLETA",
                "nro_serie" => "175700244",
                "codigo" => "2008",
                "talle_id" => 10,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "NARANJA Y NEGRO",
                "nro_serie" => "169101004",
                "codigo" => "2009",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "NARANJA Y NEGRO",
                "nro_serie" => "169101750",
                "codigo" => "2010",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "NARANJA Y NEGRO",
                "nro_serie" => "169102006",
                "codigo" => "2011",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "NARANJA Y NEGRO",
                "nro_serie" => "169101333",
                "codigo" => "2012",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "NARANJA Y NEGRO",
                "nro_serie" => "169101929",
                "codigo" => "2013",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "NARANJA Y NEGRO",
                "nro_serie" => "169100252",
                "codigo" => "2014",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "NARANJA Y NEGRO",
                "nro_serie" => "169102011",
                "codigo" => "2015",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "NARANJA Y NEGRO",
                "nro_serie" => "169100597",
                "codigo" => "2016",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "NARANJA Y NEGRO",
                "nro_serie" => "169101169",
                "codigo" => "2017",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "NARANJA Y NEGRO",
                "nro_serie" => "169101295",
                "codigo" => "2018",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "NARANJA Y NEGRO",
                "nro_serie" => "169101293",
                "codigo" => "2019",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "NARANJA Y NEGRO",
                "nro_serie" => "169100599",
                "codigo" => "2020",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "NARANJA Y NEGRO",
                "nro_serie" => "169102023",
                "codigo" => "2021",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "NARANJA Y NEGRO",
                "nro_serie" => "169100578",
                "codigo" => "2022",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "NARANJA Y NEGRO",
                "nro_serie" => "169102002",
                "codigo" => "2023",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "NARANJA Y NEGRO",
                "nro_serie" => "169101456",
                "codigo" => "2024",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "NARANJA Y NEGRO",
                "nro_serie" => "169102015",
                "codigo" => "2025",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "NARANJA Y NEGRO",
                "nro_serie" => "169101893",
                "codigo" => "2026",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "NARANJA Y NEGRO",
                "nro_serie" => "169102012",
                "codigo" => "2027",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "NARANJA Y NEGRO",
                "nro_serie" => "169101285",
                "codigo" => "2028",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "NARANJA Y NEGRO",
                "nro_serie" => "169101902",
                "codigo" => "2029",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "NEGRA Y ROJA",
                "nro_serie" => "169700951",
                "codigo" => "2030",
                "talle_id" => 14,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "NEGRA Y ROJA",
                "nro_serie" => "169701064",
                "codigo" => "2031",
                "talle_id" => 14,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "NEGRA Y ROJA",
                "nro_serie" => "169700927",
                "codigo" => "2032",
                "talle_id" => 14,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "NEGRA Y ROJA",
                "nro_serie" => "169700837",
                "codigo" => "2033",
                "talle_id" => 14,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "AZUL Y VERDE",
                "nro_serie" => "169300650",
                "codigo" => "2034",
                "talle_id" => 14,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "AZUL Y VERDE",
                "nro_serie" => "171401184",
                "codigo" => "2035",
                "talle_id" => 14,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "AZUL Y VERDE",
                "nro_serie" => "971400007",
                "codigo" => "2036",
                "talle_id" => 14,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "AZUL Y VERDE",
                "nro_serie" => "971400024",
                "codigo" => "2037",
                "talle_id" => 14,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "AZUL Y VERDE",
                "nro_serie" => "169300629",
                "codigo" => "2038",
                "talle_id" => 14,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "AZUL Y VERDE",
                "nro_serie" => "169300945",
                "codigo" => "2039",
                "talle_id" => 14,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "AZUL Y VERDE",
                "nro_serie" => "169300876",
                "codigo" => "2040",
                "talle_id" => 14,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "AZUL Y VERDE",
                "nro_serie" => "169300822",
                "codigo" => "2041",
                "talle_id" => 14,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "AZUL Y VERDE",
                "nro_serie" => "171401089",
                "codigo" => "2042",
                "talle_id" => 14,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "AZUL Y VERDE",
                "nro_serie" => "169300997",
                "codigo" => "2043",
                "talle_id" => 14,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "AZUL Y VERDE",
                "nro_serie" => "169300746",
                "codigo" => "2044",
                "talle_id" => 14,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "AZUL Y VERDE",
                "nro_serie" => "971400003",
                "codigo" => "2045",
                "talle_id" => 14,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "AZUL Y VERDE",
                "nro_serie" => "169300686",
                "codigo" => "2046",
                "talle_id" => 14,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "AZUL Y VERDE",
                "nro_serie" => "169300780",
                "codigo" => "2047",
                "talle_id" => 14,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "AZUL Y VERDE",
                "nro_serie" => "169300962",
                "codigo" => "2048",
                "talle_id" => 14,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "AZUL Y VERDE",
                "nro_serie" => "169301014",
                "codigo" => "2049",
                "talle_id" => 14,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "VERDE Y NEGRO",
                "nro_serie" => "172000110",
                "codigo" => "2050",
                "talle_id" => 17,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "VERDE Y NEGRO",
                "nro_serie" => "172000026",
                "codigo" => "2051",
                "talle_id" => 17,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "VERDE Y NEGRO",
                "nro_serie" => "172000173",
                "codigo" => "2052",
                "talle_id" => 17,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "VERDE Y NEGRO",
                "nro_serie" => "172000907",
                "codigo" => "2053",
                "talle_id" => 17,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "VERDE Y NEGRO",
                "nro_serie" => "972000004",
                "codigo" => "2054",
                "talle_id" => 17,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "AMARILLA Y NEGRO",
                "nro_serie" => "170100812",
                "codigo" => "2055",
                "talle_id" => 18,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "AMARILLA Y NEGRO",
                "nro_serie" => "170100064",
                "codigo" => "2056",
                "talle_id" => 18,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "AMARILLA Y NEGRO",
                "nro_serie" => "170100234",
                "codigo" => "2057",
                "talle_id" => 18,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "AMARILLA Y NEGRO",
                "nro_serie" => "170100272",
                "codigo" => "2058",
                "talle_id" => 18,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "LAMAR",
                "modelo" => "VIPER",
                "nro_serie" => "00177",
                "codigo" => "2059",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "LAMAR",
                "modelo" => "VIPER",
                "nro_serie" => "00180",
                "codigo" => "2060",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "LAMAR",
                "modelo" => "VIPER",
                "nro_serie" => "00140",
                "codigo" => "2061",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "LAMAR",
                "modelo" => "VIPER",
                "nro_serie" => "00002",
                "codigo" => "2062",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME WIDE",
                "nro_serie" => "19410498",
                "codigo" => "2063",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME WIDE",
                "nro_serie" => "19410494",
                "codigo" => "2064",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME WIDE",
                "nro_serie" => "19410497",
                "codigo" => "2065",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME WIDE",
                "nro_serie" => "19410496",
                "codigo" => "2066",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME WIDE",
                "nro_serie" => "19410491",
                "codigo" => "2067",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME WIDE",
                "nro_serie" => "19410489",
                "codigo" => "2068",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME WIDE",
                "nro_serie" => "20350023",
                "codigo" => "2069",
                "talle_id" => 18,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME WIDE",
                "nro_serie" => "20350024",
                "codigo" => "2070",
                "talle_id" => 18,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME WIDE",
                "nro_serie" => "19430127",
                "codigo" => "2071",
                "talle_id" => 18,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME WIDE",
                "nro_serie" => "19370484",
                "codigo" => "2072",
                "talle_id" => 18,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME WIDE",
                "nro_serie" => "19380037",
                "codigo" => "2073",
                "talle_id" => 18,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME WIDE",
                "nro_serie" => "19430127",
                "codigo" => "2074",
                "talle_id" => 18,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME WIDE",
                "nro_serie" => "20200082",
                "codigo" => "2075",
                "talle_id" => 18,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME WIDE",
                "nro_serie" => "20340022",
                "codigo" => "2076",
                "talle_id" => 18,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME WIDE",
                "nro_serie" => "20310665",
                "codigo" => "2077",
                "talle_id" => 18,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME WIDE",
                "nro_serie" => "20320098",
                "codigo" => "2078",
                "talle_id" => 18,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME WIDE",
                "nro_serie" => "20200086",
                "codigo" => "2079",
                "talle_id" => 18,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME WIDE",
                "nro_serie" => "19410531",
                "codigo" => "2080",
                "talle_id" => 18,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME WIDE",
                "nro_serie" => "19370439",
                "codigo" => "2081",
                "talle_id" => 18,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME  PRIME MCMXC VERDE VERDE",
                "nro_serie" => "18410165",
                "codigo" => "2082",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME  PRIME MCMXC VERDE VERDE",
                "nro_serie" => "18410158",
                "codigo" => "2083",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME  PRIME MCMXC VERDE VERDE",
                "nro_serie" => "19010011",
                "codigo" => "2084",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME  PRIME MCMXC VERDE VERDE",
                "nro_serie" => "19010012",
                "codigo" => "2085",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME  PRIME MCMXC VERDE VERDE",
                "nro_serie" => "17490915",
                "codigo" => "2087",
                "talle_id" => 18,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME  PRIME MCMXC VERDE VERDE",
                "nro_serie" => "17490806",
                "codigo" => "2088",
                "talle_id" => 18,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "MAGNUM",
                "nro_serie" => "19360618",
                "codigo" => "2089",
                "talle_id" => 18,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "MAGNUM",
                "nro_serie" => "19360621",
                "codigo" => "2090",
                "talle_id" => 18,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "MAGNUM",
                "nro_serie" => "19410411",
                "codigo" => "2091",
                "talle_id" => 18,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "TEAM CLASSIC",
                "nro_serie" => "19390004",
                "codigo" => "2092",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "TEAM CLASSIC",
                "nro_serie" => "18060008",
                "codigo" => "2093",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "TEAM CLASSIC",
                "nro_serie" => "18060005",
                "codigo" => "2094",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "TEAM CLASSIC",
                "nro_serie" => "18060007",
                "codigo" => "2095",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "TEAM CLASSIC",
                "nro_serie" => "18060009",
                "codigo" => "2096",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "TEAM CLASSIC",
                "nro_serie" => "18052702",
                "codigo" => "2097",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "TEAM CLASSIC",
                "nro_serie" => "18052693",
                "codigo" => "2098",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "TEAM CLASSIC",
                "nro_serie" => "18052706",
                "codigo" => "2099",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "VICTORIA",
                "nro_serie" => "15350442",
                "codigo" => "2100",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "NITRO",
                "modelo" => "VICTORIA",
                "nro_serie" => "15310944",
                "codigo" => "2101",
                "talle_id" => 14,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "NITRO",
                "modelo" => "MYSTIQUE",
                "nro_serie" => "20310572",
                "codigo" => "2103",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "MYSTIQUE",
                "nro_serie" => "20310565",
                "codigo" => "2104",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "MYSTIQUE",
                "nro_serie" => "20210943",
                "codigo" => "2105",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "MYSTIQUE",
                "nro_serie" => "20270042",
                "codigo" => "2106",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME COLORES",
                "nro_serie" => "19370356",
                "codigo" => "2107",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME COLORES",
                "nro_serie" => "19370371",
                "codigo" => "2108",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME COLORES",
                "nro_serie" => "19370367",
                "codigo" => "2109",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME COLORES",
                "nro_serie" => "19370366",
                "codigo" => "2110",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME COLORES",
                "nro_serie" => "19370359",
                "codigo" => "2111",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME COLORES",
                "nro_serie" => "19360953",
                "codigo" => "2112",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME COLORES",
                "nro_serie" => "19360957",
                "codigo" => "2113",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME COLORES",
                "nro_serie" => "19360954",
                "codigo" => "2114",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME COLORES",
                "nro_serie" => "19360952",
                "codigo" => "2115",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME COLORES",
                "nro_serie" => "19410504",
                "codigo" => "2116",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME COLORES",
                "nro_serie" => "19100157",
                "codigo" => "2117",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME COLORES",
                "nro_serie" => "19100148",
                "codigo" => "2118",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME WIDE COLORES",
                "nro_serie" => "19360974",
                "codigo" => "2119",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME WIDE COLORES",
                "nro_serie" => "19360961",
                "codigo" => "2120",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME WIDE COLORES",
                "nro_serie" => "19360963",
                "codigo" => "2121",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME WIDE COLORES",
                "nro_serie" => "19360960",
                "codigo" => "2122",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME WIDE COLORES",
                "nro_serie" => "19450008",
                "codigo" => "2123",
                "talle_id" => 18,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "SMP",
                "nro_serie" => "19410467",
                "codigo" => "2124",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "SMP",
                "nro_serie" => "19410469",
                "codigo" => "2125",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "SMP",
                "nro_serie" => "19410468",
                "codigo" => "2126",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "SMP",
                "nro_serie" => "19361052",
                "codigo" => "2127",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "SMP",
                "nro_serie" => "19360648",
                "codigo" => "2128",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "SMP",
                "nro_serie" => "19360646",
                "codigo" => "2129",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "SMP",
                "nro_serie" => "19361050",
                "codigo" => "2130",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "SMP",
                "nro_serie" => "19361036",
                "codigo" => "2131",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "SMP",
                "nro_serie" => "19361037",
                "codigo" => "2132",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "CHEAPTHRILLS",
                "nro_serie" => "19191397",
                "codigo" => "2133",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "CHEAPTHRILLS",
                "nro_serie" => "19191394",
                "codigo" => "2134",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "CHEAPTHRILLS",
                "nro_serie" => "19191377",
                "codigo" => "2135",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "CHEAPTHRILLS",
                "nro_serie" => "19191398",
                "codigo" => "2136",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "CHEAPTHRILLS",
                "nro_serie" => "19191385",
                "codigo" => "2137",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "CHEAPTHRILLS",
                "nro_serie" => "19180009",
                "codigo" => "2138",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "CHEAPTHRILLS",
                "nro_serie" => "19180010",
                "codigo" => "2139",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "CHEAPTHRILLS",
                "nro_serie" => "19420345",
                "codigo" => "2140",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "CHEAPTHRILLS",
                "nro_serie" => "19420346",
                "codigo" => "2141",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "CHEAPTHRILLS",
                "nro_serie" => "19191443",
                "codigo" => "2142",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "CHEAPTHRILLS",
                "nro_serie" => "19191435",
                "codigo" => "2143",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "CHEAPTHRILLS",
                "nro_serie" => "19191253",
                "codigo" => "2144",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "CHEAPTHRILLS",
                "nro_serie" => "19191420",
                "codigo" => "2145",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "CHEAPTHRILLS",
                "nro_serie" => "19220929",
                "codigo" => "2146",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "CHEAPTHRILLS",
                "nro_serie" => "19190050",
                "codigo" => "2147",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "CHEAPTHRILLS",
                "nro_serie" => "19191425",
                "codigo" => "2148",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "CHEAPTHRILLS",
                "nro_serie" => "19191430",
                "codigo" => "2149",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "CHEAPTHRILLS",
                "nro_serie" => "19191250",
                "codigo" => "2150",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "CHEAPTHRILLS",
                "nro_serie" => "19190056",
                "codigo" => "2151",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "CHEAPTHRILLS",
                "nro_serie" => "19190053",
                "codigo" => "2152",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "CHEAPTHRILLS",
                "nro_serie" => "19191249",
                "codigo" => "2153",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "CHEAPTHRILLS",
                "nro_serie" => "19191251",
                "codigo" => "2154",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "CHEAPTHRILLS",
                "nro_serie" => "19190057",
                "codigo" => "2155",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "CHEAPTHRILLS",
                "nro_serie" => "19190055",
                "codigo" => "2156",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "RIPPER NARANJA JR",
                "nro_serie" => "18460029",
                "codigo" => "2157",
                "talle_id" => 7,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "NITRO",
                "modelo" => "RIPPER NARANJA JR",
                "nro_serie" => "17490942",
                "codigo" => "2158",
                "talle_id" => 7,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "NITRO",
                "modelo" => "RIPPER NARANJA JR",
                "nro_serie" => "17490932",
                "codigo" => "2159",
                "talle_id" => 7,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "NITRO",
                "modelo" => "RIPPER NARANJA JR",
                "nro_serie" => "18291226",
                "codigo" => "2160",
                "talle_id" => 7,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "NITRO",
                "modelo" => "RIPPER NARANJA JR",
                "nro_serie" => "17490931",
                "codigo" => "2161",
                "talle_id" => 7,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "NITRO",
                "modelo" => "RIPPER NARANJA JR",
                "nro_serie" => "18291222",
                "codigo" => "2162",
                "talle_id" => 7,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "NITRO",
                "modelo" => "RIPPER NARANJA JR",
                "nro_serie" => "17490943",
                "codigo" => "2163",
                "talle_id" => 7,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "NITRO",
                "modelo" => "RIPPER NARANJA JR",
                "nro_serie" => "17490784",
                "codigo" => "2164",
                "talle_id" => 8,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "NITRO",
                "modelo" => "RIPPER NARANJA JR",
                "nro_serie" => "17490785",
                "codigo" => "2165",
                "talle_id" => 8,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "NITRO",
                "modelo" => "RIPPER NARANJA JR",
                "nro_serie" => "18340159",
                "codigo" => "2166",
                "talle_id" => 9,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "NITRO",
                "modelo" => "RIPPER NARANJA JR",
                "nro_serie" => "18340160",
                "codigo" => "2167",
                "talle_id" => 9,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "NITRO",
                "modelo" => "BEAST BOSQUE",
                "nro_serie" => "18052049",
                "codigo" => "2168",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "BEAST BOSQUE",
                "nro_serie" => "18090966",
                "codigo" => "2169",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "BEAST BOSQUE",
                "nro_serie" => "18220038",
                "codigo" => "2170",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "BEAST BOSQUE",
                "nro_serie" => "18052866",
                "codigo" => "2171",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "BEAST BOSQUE",
                "nro_serie" => "18220117",
                "codigo" => "2172",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "LAMAR",
                "modelo" => "ICIX",
                "nro_serie" => "0920110080",
                "codigo" => "2173",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "LAMAR",
                "modelo" => "ICIX",
                "nro_serie" => "0920110186",
                "codigo" => "2174",
                "talle_id" => 14,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "LAMAR",
                "modelo" => "ICIX",
                "nro_serie" => "0920110014",
                "codigo" => "2175",
                "talle_id" => 14,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "LAMAR",
                "modelo" => "ICIX",
                "nro_serie" => "0920110165",
                "codigo" => "2176",
                "talle_id" => 17,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "LAMAR",
                "modelo" => "ICIX",
                "nro_serie" => "0920110168",
                "codigo" => "2177",
                "talle_id" => 17,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "NITRO",
                "modelo" => "RIPPER AMARILLO",
                "nro_serie" => "18410240",
                "codigo" => "2178",
                "talle_id" => 4,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "NITRO",
                "modelo" => "RIPPER AMARILLO",
                "nro_serie" => "18410236",
                "codigo" => "2180",
                "talle_id" => 4,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "NITRO",
                "modelo" => "RIPPER AMARILLO",
                "nro_serie" => "18410237",
                "codigo" => "2182",
                "talle_id" => 4,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "NITRO",
                "modelo" => "RIPPER AMARILLO",
                "nro_serie" => "18340235",
                "codigo" => "2184",
                "talle_id" => 5,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "NITRO",
                "modelo" => "RIPPER AMARILLO",
                "nro_serie" => "18340289",
                "codigo" => "2185",
                "talle_id" => 5,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "NITRO",
                "modelo" => "RIPPER AMARILLO",
                "nro_serie" => "18340291",
                "codigo" => "2188",
                "talle_id" => 5,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "NITRO",
                "modelo" => "MYSTIQUE CELESTE",
                "nro_serie" => "17430448",
                "codigo" => "2189",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "MYSTIQUE CELESTE",
                "nro_serie" => "17430450",
                "codigo" => "2190",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "MYSTIQUE CELESTE",
                "nro_serie" => "19291302",
                "codigo" => "2191",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "MYSTIQUE CELESTE",
                "nro_serie" => "17410031",
                "codigo" => "2192",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "MYSTIQUE CELESTE",
                "nro_serie" => "18291311",
                "codigo" => "2193",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "MYSTIQUE CELESTE",
                "nro_serie" => "1830002",
                "codigo" => "2194",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "MYSTIQUE CELESTE",
                "nro_serie" => "1830003",
                "codigo" => "2195",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "MYSTIQUE CELESTE",
                "nro_serie" => "18180004",
                "codigo" => "2196",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "SAPIENT",
                "modelo" => "VERDE JR",
                "nro_serie" => "30511072",
                "codigo" => "2197",
                "talle_id" => 7,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SAPIENT",
                "modelo" => "VERDE JR",
                "nro_serie" => "30511129",
                "codigo" => "2198",
                "talle_id" => 7,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SAPIENT",
                "modelo" => "VERDE JR",
                "nro_serie" => "30511117",
                "codigo" => "2199",
                "talle_id" => 7,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SAPIENT",
                "modelo" => "VERDE JR",
                "nro_serie" => "30511089",
                "codigo" => "2200",
                "talle_id" => 7,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SAPIENT",
                "modelo" => "VERDE JR",
                "nro_serie" => "30511058",
                "codigo" => "2201",
                "talle_id" => 7,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SAPIENT",
                "modelo" => "VERDE JR",
                "nro_serie" => "29811075",
                "codigo" => "2202",
                "talle_id" => 7,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SAPIENT",
                "modelo" => "VERDE JR",
                "nro_serie" => "30511059",
                "codigo" => "2203",
                "talle_id" => 7,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SAPIENT",
                "modelo" => "VERDE JR",
                "nro_serie" => "30511095",
                "codigo" => "2204",
                "talle_id" => 7,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SAPIENT",
                "modelo" => "VERDE JR",
                "nro_serie" => "30511062",
                "codigo" => "2205",
                "talle_id" => 7,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SAPIENT",
                "modelo" => "VERDE JR",
                "nro_serie" => "30511130",
                "codigo" => "2206",
                "talle_id" => 7,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SAPIENT",
                "modelo" => "VERDE JR",
                "nro_serie" => "30511138",
                "codigo" => "2207",
                "talle_id" => 7,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SAPIENT",
                "modelo" => "VERDE JR",
                "nro_serie" => "30511142",
                "codigo" => "2208",
                "talle_id" => 7,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SAPIENT",
                "modelo" => "VERDE JR",
                "nro_serie" => "30511141",
                "codigo" => "2209",
                "talle_id" => 7,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SAPIENT",
                "modelo" => "VERDE JR",
                "nro_serie" => "30511099",
                "codigo" => "2210",
                "talle_id" => 7,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "NITRO",
                "modelo" => "TEAM MCMXC",
                "nro_serie" => "19270026",
                "codigo" => "2211",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "TEAM MCMXC",
                "nro_serie" => "19431048",
                "codigo" => "2212",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "TEAM MCMXC",
                "nro_serie" => "19361174",
                "codigo" => "2213",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "TEAM MCMXC",
                "nro_serie" => "19361175",
                "codigo" => "2214",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "TEAM MCMXC",
                "nro_serie" => "19400215",
                "codigo" => "2215",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "TEAM MCMXC",
                "nro_serie" => "19400216",
                "codigo" => "2216",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "TEAM MCMXC",
                "nro_serie" => "19160430",
                "codigo" => "2217",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "ARIAL",
                "nro_serie" => "17081221",
                "codigo" => "2218",
                "talle_id" => 9,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "ARIAL",
                "nro_serie" => "17081181",
                "codigo" => "2219",
                "talle_id" => 9,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "ARIAL",
                "nro_serie" => "17081184",
                "codigo" => "2220",
                "talle_id" => 9,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "ARIAL",
                "nro_serie" => "17081170",
                "codigo" => "2221",
                "talle_id" => 9,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "ARIAL",
                "nro_serie" => "17081205",
                "codigo" => "2222",
                "talle_id" => 9,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "ARIAL",
                "nro_serie" => "17081211",
                "codigo" => "2223",
                "talle_id" => 9,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "ARIAL",
                "nro_serie" => "17081220",
                "codigo" => "2224",
                "talle_id" => 9,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "ARIAL",
                "nro_serie" => "17081168",
                "codigo" => "2225",
                "talle_id" => 9,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "ARIAL",
                "nro_serie" => "17081166",
                "codigo" => "2226",
                "talle_id" => 9,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "ARIAL",
                "nro_serie" => "17081169",
                "codigo" => "2227",
                "talle_id" => 9,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "ARIAL",
                "nro_serie" => "17081212",
                "codigo" => "2228",
                "talle_id" => 9,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "ARIAL",
                "nro_serie" => "17081209",
                "codigo" => "2229",
                "talle_id" => 9,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "STANDARD NEGRO",
                "nro_serie" => "13240058",
                "codigo" => "2231",
                "talle_id" => 17,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "NITRO",
                "modelo" => "STANDARD NEGRO",
                "nro_serie" => "13112577",
                "codigo" => "2232",
                "talle_id" => 18,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "NITRO",
                "modelo" => "STANDARD NEGRO",
                "nro_serie" => "13170022",
                "codigo" => "2233",
                "talle_id" => 21,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "NITRO",
                "modelo" => "STANDARD NEGRO",
                "nro_serie" => "13240385",
                "codigo" => "2234",
                "talle_id" => 21,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "NITRO",
                "modelo" => "STANDARD NEGRO",
                "nro_serie" => "13240046",
                "codigo" => "2235",
                "talle_id" => 21,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "NITRO",
                "modelo" => "ARIAL",
                "nro_serie" => "17100189",
                "codigo" => "2236",
                "talle_id" => 9,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "ARIAL",
                "nro_serie" => "17100195",
                "codigo" => "2237",
                "talle_id" => 9,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "ARIAL",
                "nro_serie" => "17100200",
                "codigo" => "2238",
                "talle_id" => 9,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "ARIAL",
                "nro_serie" => "16502432",
                "codigo" => "2239",
                "talle_id" => 10,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "ARIAL",
                "nro_serie" => "16502434",
                "codigo" => "2240",
                "talle_id" => 10,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "ARIAL",
                "nro_serie" => "16502443",
                "codigo" => "2241",
                "talle_id" => 10,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "LTD",
                "modelo" => "MFG SINCE 1993",
                "nro_serie" => "201110000127",
                "codigo" => "2242",
                "talle_id" => 1,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "LTD",
                "modelo" => "MFG SINCE 1993",
                "nro_serie" => "201111000441",
                "codigo" => "2243",
                "talle_id" => 3,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "LTD",
                "modelo" => "MFG SINCE 1993",
                "nro_serie" => "201114100146",
                "codigo" => "2244",
                "talle_id" => 9,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "FORUM",
                "modelo" => "MANUAL",
                "nro_serie" => "172100822",
                "codigo" => "2245",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "FORUM",
                "modelo" => "MANUAL",
                "nro_serie" => "172100794",
                "codigo" => "2246",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "FORUM",
                "modelo" => "MANUAL",
                "nro_serie" => "172100796",
                "codigo" => "2247",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "FORUM",
                "modelo" => "MANUAL",
                "nro_serie" => "172100831",
                "codigo" => "2248",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "VERDE",
                "nro_serie" => "177100751",
                "codigo" => "2249",
                "talle_id" => 17,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SIMS",
                "modelo" => "WRATH",
                "nro_serie" => "08202012240191580081",
                "codigo" => "2250",
                "talle_id" => 17,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "LTD",
                "modelo" => "VENOM",
                "nro_serie" => "08201215100018",
                "codigo" => "2251",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "NITRO",
                "modelo" => "FATE",
                "nro_serie" => "16410240",
                "codigo" => "2252",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "STANCE NSBC ",
                "nro_serie" => "17391202",
                "codigo" => "2253",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "STANCE NSBC ",
                "nro_serie" => "17391192",
                "codigo" => "2254",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "RIDE",
                "modelo" => "AGENDA",
                "nro_serie" => "0741147",
                "codigo" => "2256",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "RIDE",
                "modelo" => "AGENDA",
                "nro_serie" => "6685147",
                "codigo" => "2257",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "RIDE",
                "modelo" => "AGENDA",
                "nro_serie" => "6695147",
                "codigo" => "2258",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "RIDE",
                "modelo" => "AGENDA",
                "nro_serie" => "6692147",
                "codigo" => "2259",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "RIDE",
                "modelo" => "AGENDA",
                "nro_serie" => "6678147",
                "codigo" => "2260",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "RIDE",
                "modelo" => "AGENDA",
                "nro_serie" => "0740147",
                "codigo" => "2261",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "RIDE",
                "modelo" => "AGENDA",
                "nro_serie" => "8696147",
                "codigo" => "2262",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "RIDE",
                "modelo" => "AGENDA",
                "nro_serie" => "0663147",
                "codigo" => "2263",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "RIDE",
                "modelo" => "AGENDA",
                "nro_serie" => "6682147",
                "codigo" => "2264",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "RIDE",
                "modelo" => "AGENDA",
                "nro_serie" => "6676147",
                "codigo" => "2265",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "NITRO",
                "modelo" => "MYSTIQUE NEGRO",
                "nro_serie" => "18351391",
                "codigo" => "2266",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "MYSTIQUE NEGRO",
                "nro_serie" => "183513644",
                "codigo" => "2267",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "MYSTIQUE NEGRO",
                "nro_serie" => "18351310",
                "codigo" => "2268",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "MYSTIQUE NEGRO",
                "nro_serie" => "18360191",
                "codigo" => "2269",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "MYSTIQUE NEGRO",
                "nro_serie" => "183513645",
                "codigo" => "2270",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "FIFTY ONE",
                "modelo" => "SHOOTER",
                "nro_serie" => "12325421",
                "codigo" => "2271",
                "talle_id" => 9,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "FIFTY ONE",
                "modelo" => "SHOOTER",
                "nro_serie" => "12332094",
                "codigo" => "2272",
                "talle_id" => 9,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "FIFTY ONE",
                "modelo" => "SHOOTER",
                "nro_serie" => "12266151",
                "codigo" => "2273",
                "talle_id" => 9,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "FIFTY ONE",
                "modelo" => "SHOOTER",
                "nro_serie" => "12617398",
                "codigo" => "2274",
                "talle_id" => 9,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "FIFTY ONE",
                "modelo" => "SHOOTER",
                "nro_serie" => "12317399",
                "codigo" => "2275",
                "talle_id" => 9,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "FIFTY ONE",
                "modelo" => "SHOOTER",
                "nro_serie" => "12325423",
                "codigo" => "2276",
                "talle_id" => 9,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "FIFTY ONE",
                "modelo" => "SHOOTER",
                "nro_serie" => "12332110",
                "codigo" => "2277",
                "talle_id" => 9,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "FIFTY ONE",
                "modelo" => "SHOOTER",
                "nro_serie" => "12325420",
                "codigo" => "2278",
                "talle_id" => 9,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "FIFTY ONE",
                "modelo" => "SHOOTER",
                "nro_serie" => "12380432",
                "codigo" => "2279",
                "talle_id" => 9,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "FIFTY ONE",
                "modelo" => "SHOOTER",
                "nro_serie" => "12317405",
                "codigo" => "2280",
                "talle_id" => 9,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "FIFTY ONE",
                "modelo" => "SHOOTER",
                "nro_serie" => "12317397",
                "codigo" => "2281",
                "talle_id" => 9,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "FIFTY ONE",
                "modelo" => "SHOOTER",
                "nro_serie" => "12332105",
                "codigo" => "2282",
                "talle_id" => 9,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "FIFTY ONE",
                "modelo" => "SHOOTER",
                "nro_serie" => "12325424",
                "codigo" => "2283",
                "talle_id" => 9,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "FIFTY ONE",
                "modelo" => "SHOOTER",
                "nro_serie" => "12317404",
                "codigo" => "2284",
                "talle_id" => 9,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "ROSSIGNOL",
                "modelo" => "CONTRAST",
                "nro_serie" => "82711565",
                "codigo" => "2286",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "ROSSIGNOL",
                "modelo" => "CONTRAST",
                "nro_serie" => "8271564",
                "codigo" => "2287",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "ROSSIGNOL",
                "modelo" => "CONTRAST",
                "nro_serie" => "8270642",
                "codigo" => "2288",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "ROSSIGNOL",
                "modelo" => "CONTRAST",
                "nro_serie" => "8273313",
                "codigo" => "2289",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "ROSSIGNOL",
                "modelo" => "CONTRAST",
                "nro_serie" => "8270623",
                "codigo" => "2290",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "ROSSIGNOL",
                "modelo" => "CONTRAST",
                "nro_serie" => "8271568",
                "codigo" => "2291",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SAPIENT",
                "modelo" => "ROJA",
                "nro_serie" => "40511276",
                "codigo" => "2292",
                "talle_id" => 9,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SAPIENT",
                "modelo" => "ROJA",
                "nro_serie" => "40511198",
                "codigo" => "2293",
                "talle_id" => 9,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SAPIENT",
                "modelo" => "ROJA",
                "nro_serie" => "40511225",
                "codigo" => "2294",
                "talle_id" => 9,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "ROSSIGNOL",
                "modelo" => "CONTRAST",
                "nro_serie" => "8278828",
                "codigo" => "2295",
                "talle_id" => 14,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SAPIENT",
                "modelo" => "ROJA",
                "nro_serie" => "45511443",
                "codigo" => "2296",
                "talle_id" => 10,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SAPIENT",
                "modelo" => "ROJA",
                "nro_serie" => "45511071",
                "codigo" => "2297",
                "talle_id" => 10,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SAPIENT",
                "modelo" => "ROJA",
                "nro_serie" => "45511055",
                "codigo" => "2298",
                "talle_id" => 10,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SAPIENT",
                "modelo" => "ROJA",
                "nro_serie" => "45511066",
                "codigo" => "2299",
                "talle_id" => 10,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SAPIENT",
                "modelo" => "ROJA",
                "nro_serie" => "45511081",
                "codigo" => "2300",
                "talle_id" => 10,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SAPIENT",
                "modelo" => "ROJA",
                "nro_serie" => "45511082",
                "codigo" => "2301",
                "talle_id" => 10,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SAPIENT",
                "modelo" => "ROJA",
                "nro_serie" => "45511057",
                "codigo" => "2302",
                "talle_id" => 10,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SAPIENT",
                "modelo" => "ROJA",
                "nro_serie" => "45511058",
                "codigo" => "2303",
                "talle_id" => 10,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SAPIENT",
                "modelo" => "ROJA",
                "nro_serie" => "45511076",
                "codigo" => "2304",
                "talle_id" => 10,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SAPIENT",
                "modelo" => "ROJA",
                "nro_serie" => "45511079",
                "codigo" => "2305",
                "talle_id" => 10,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SAPIENT",
                "modelo" => "ROJA",
                "nro_serie" => "45511090",
                "codigo" => "2306",
                "talle_id" => 10,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SAPIENT",
                "modelo" => "ROJA",
                "nro_serie" => "45511067",
                "codigo" => "2307",
                "talle_id" => 10,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "NITRO",
                "modelo" => "SMP COLORES",
                "nro_serie" => "18351085",
                "codigo" => "2308",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "SMP COLORES",
                "nro_serie" => "18360413",
                "codigo" => "2309",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "SMP COLORES",
                "nro_serie" => "18350759",
                "codigo" => "2310",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "SMP COLORES",
                "nro_serie" => "18350756",
                "codigo" => "2311",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "SMP COLORES",
                "nro_serie" => "18360416",
                "codigo" => "2312",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "SMP COLORES",
                "nro_serie" => "18350777",
                "codigo" => "2313",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME NARANJA",
                "nro_serie" => "17410231",
                "codigo" => "2314",
                "talle_id" => 14,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME NARANJA",
                "nro_serie" => "17160029",
                "codigo" => "2315",
                "talle_id" => 17,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME NARANJA",
                "nro_serie" => "17160030",
                "codigo" => "2316",
                "talle_id" => 17,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME NARANJA",
                "nro_serie" => "17160050",
                "codigo" => "2317",
                "talle_id" => 18,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JR NEMI",
                "nro_serie" => "23401813",
                "codigo" => "2318",
                "talle_id" => 4,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JR NEMI",
                "nro_serie" => "18300823",
                "codigo" => "2319",
                "talle_id" => 4,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "LTD",
                "modelo" => "RAIDER",
                "nro_serie" => "201110000942",
                "codigo" => "2320",
                "talle_id" => 1,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "LTD",
                "modelo" => "RAIDER",
                "nro_serie" => "201113001192",
                "codigo" => "2321",
                "talle_id" => 7,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "LTD",
                "modelo" => "RAIDER",
                "nro_serie" => "201113600970",
                "codigo" => "2322",
                "talle_id" => 8,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "LTD",
                "modelo" => "RAIDER",
                "nro_serie" => "201113600971",
                "codigo" => "2323",
                "talle_id" => 8,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "LTD",
                "modelo" => "RAIDER",
                "nro_serie" => "201113600973",
                "codigo" => "2324",
                "talle_id" => 8,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "LTD",
                "modelo" => "RAIDER",
                "nro_serie" => "201114001170",
                "codigo" => "2325",
                "talle_id" => 9,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "LTD",
                "modelo" => "RAIDER",
                "nro_serie" => "201114000039",
                "codigo" => "2326",
                "talle_id" => 9,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "LAMAR",
                "modelo" => "PIXE",
                "nro_serie" => "201114100257",
                "codigo" => "2327",
                "talle_id" => 9,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "LAMAR",
                "modelo" => "PIXE",
                "nro_serie" => "201114800027",
                "codigo" => "2328",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "LAMAR",
                "modelo" => "ESSENCE",
                "nro_serie" => "07201114000236",
                "codigo" => "2329",
                "talle_id" => 9,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "LAMAR",
                "modelo" => "ESSENCE",
                "nro_serie" => "08201115100714",
                "codigo" => "2330",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "LAMAR",
                "modelo" => "HUNTER",
                "nro_serie" => "08201215400053",
                "codigo" => "2331",
                "talle_id" => 14,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "LAMAR",
                "modelo" => "HUNTER",
                "nro_serie" => "08201215400040",
                "codigo" => "2332",
                "talle_id" => 14,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "LTD",
                "modelo" => "GEO",
                "nro_serie" => "1116100059",
                "codigo" => "2333",
                "talle_id" => 17,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SALOMON",
                "modelo" => "VIOLETA LARK",
                "nro_serie" => "12657534",
                "codigo" => "2334",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "TECHNINE",
                "modelo" => "DO YOUR THING",
                "nro_serie" => "20111707",
                "codigo" => "2335",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "NITRO",
                "modelo" => "FUSION ROJA",
                "nro_serie" => "19420160",
                "codigo" => "2336",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "LAMAR",
                "modelo" => "BELLE",
                "nro_serie" => "03201215100014",
                "codigo" => "2337",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "FORUM",
                "modelo" => "CHILLY DOG",
                "nro_serie" => "187800014",
                "codigo" => "2338",
                "talle_id" => 8,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "FORUM",
                "modelo" => "CHILLY DOG",
                "nro_serie" => "187800015",
                "codigo" => "2339",
                "talle_id" => 8,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "FORUM",
                "modelo" => "CHILLY DOG",
                "nro_serie" => "187800043",
                "codigo" => "2340",
                "talle_id" => 8,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SIMS",
                "modelo" => "WRATH",
                "nro_serie" => "082020122401915800228",
                "codigo" => "2341",
                "talle_id" => 17,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "KAN",
                "modelo" => "JR",
                "nro_serie" => "005690",
                "codigo" => "2342",
                "talle_id" => 57,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "KAN",
                "modelo" => "JR",
                "nro_serie" => "395990",
                "codigo" => "2343",
                "talle_id" => 57,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "KAN",
                "modelo" => "JR",
                "nro_serie" => "005990",
                "codigo" => "2344",
                "talle_id" => 57,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "KAN",
                "modelo" => "JR",
                "nro_serie" => "005790",
                "codigo" => "2345",
                "talle_id" => 57,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "KAN",
                "modelo" => "JR",
                "nro_serie" => "695890",
                "codigo" => "2346",
                "talle_id" => 57,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "KAN",
                "modelo" => "JR",
                "nro_serie" => "396990",
                "codigo" => "2347",
                "talle_id" => 57,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "KAN",
                "modelo" => "JR",
                "nro_serie" => "397190",
                "codigo" => "2348",
                "talle_id" => 57,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "KAN",
                "modelo" => "JR",
                "nro_serie" => "396790",
                "codigo" => "2349",
                "talle_id" => 57,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "KAN",
                "modelo" => "JR",
                "nro_serie" => "005390",
                "codigo" => "2350",
                "talle_id" => 57,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "KAN",
                "modelo" => "JR",
                "nro_serie" => "2205100",
                "codigo" => "2351",
                "talle_id" => 1,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "KAN",
                "modelo" => "JR",
                "nro_serie" => "06220100",
                "codigo" => "2352",
                "talle_id" => 1,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "KAN",
                "modelo" => "JR",
                "nro_serie" => "0101100",
                "codigo" => "2353",
                "talle_id" => 1,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "KAN",
                "modelo" => "JR",
                "nro_serie" => "0102100",
                "codigo" => "2354",
                "talle_id" => 1,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "KAN",
                "modelo" => "JR",
                "nro_serie" => "0116100",
                "codigo" => "2355",
                "talle_id" => 1,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "KAN",
                "modelo" => "JR",
                "nro_serie" => "0117100",
                "codigo" => "2356",
                "talle_id" => 1,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "KAN",
                "modelo" => "JR",
                "nro_serie" => "2197100",
                "codigo" => "2357",
                "talle_id" => 1,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "KAN",
                "modelo" => "JR",
                "nro_serie" => "0497100",
                "codigo" => "2358",
                "talle_id" => 1,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "KAN",
                "modelo" => "JR",
                "nro_serie" => "0498100",
                "codigo" => "2359",
                "talle_id" => 1,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "KAN",
                "modelo" => "JR",
                "nro_serie" => "0049110",
                "codigo" => "2360",
                "talle_id" => 3,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "KAN",
                "modelo" => "JR",
                "nro_serie" => "0155110",
                "codigo" => "2361",
                "talle_id" => 3,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "KAN",
                "modelo" => "JR",
                "nro_serie" => "0154110",
                "codigo" => "2362",
                "talle_id" => 3,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "KAN",
                "modelo" => "JR",
                "nro_serie" => "0050110",
                "codigo" => "2363",
                "talle_id" => 3,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "KAN",
                "modelo" => "JR",
                "nro_serie" => "0040110",
                "codigo" => "2364",
                "talle_id" => 3,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "KAN",
                "modelo" => "JR",
                "nro_serie" => "0157110",
                "codigo" => "2365",
                "talle_id" => 3,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "KAN",
                "modelo" => "JR",
                "nro_serie" => "0041110",
                "codigo" => "2366",
                "talle_id" => 3,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "NITRO",
                "modelo" => "FUSION BLANCA",
                "nro_serie" => "185000003",
                "codigo" => "2367",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "FUSION BLANCA",
                "nro_serie" => "19460051",
                "codigo" => "2368",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "LTD",
                "modelo" => "ANGEL",
                "nro_serie" => "08201215100011",
                "codigo" => "2369",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "TECHNINE",
                "modelo" => "MUJERES",
                "nro_serie" => "2012170281500003",
                "codigo" => "2370",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "NITRO",
                "modelo" => "VISUAL LIBERATION",
                "nro_serie" => "13111972",
                "codigo" => "2371",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "NITRO",
                "modelo" => "STANCE NARANJA Y CELESTE",
                "nro_serie" => "14360985",
                "codigo" => "2372",
                "talle_id" => 14,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "NITRO",
                "modelo" => "STANCE NARANJA Y CELESTE",
                "nro_serie" => "14280259",
                "codigo" => "2373",
                "talle_id" => 14,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "NITRO",
                "modelo" => "STANCE NARANJA Y CELESTE",
                "nro_serie" => "14280256",
                "codigo" => "2374",
                "talle_id" => 17,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SAPIENT",
                "modelo" => "VIOLETA Y BLANCO",
                "nro_serie" => "0820110075",
                "codigo" => "2375",
                "talle_id" => 10,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SAPIENT",
                "modelo" => "VIOLETA Y BLANCO",
                "nro_serie" => "0820110104",
                "codigo" => "2376",
                "talle_id" => 10,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SAPIENT",
                "modelo" => "VIOLETA Y BLANCO",
                "nro_serie" => "0820110175",
                "codigo" => "2377",
                "talle_id" => 10,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SAPIENT",
                "modelo" => "VIOLETA Y BLANCO",
                "nro_serie" => "0820110231",
                "codigo" => "2378",
                "talle_id" => 10,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SAPIENT",
                "modelo" => "VIOLETA Y BLANCO",
                "nro_serie" => "0820110226",
                "codigo" => "2379",
                "talle_id" => 10,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "LAMAR",
                "modelo" => "TROPPER",
                "nro_serie" => "08201215100007",
                "codigo" => "2380",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BURTON",
                "modelo" => "CHICKLET JR",
                "nro_serie" => "181100449",
                "codigo" => "2381",
                "talle_id" => 4,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "LAMAR",
                "modelo" => "VIPER NEGRA",
                "nro_serie" => "0920110156",
                "codigo" => "2382",
                "talle_id" => 17,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "LTD",
                "modelo" => "PULSE",
                "nro_serie" => "06201114100070",
                "codigo" => "2383",
                "talle_id" => 9,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "LTD",
                "modelo" => "GEO JR",
                "nro_serie" => "08201110000268",
                "codigo" => "2384",
                "talle_id" => 1,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "LTD",
                "modelo" => "GEO JR",
                "nro_serie" => "08201110000251",
                "codigo" => "2385",
                "talle_id" => 1,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "LTD",
                "modelo" => "GEO JR",
                "nro_serie" => "08201112500706",
                "codigo" => "2386",
                "talle_id" => 6,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "LTD",
                "modelo" => "GEO JR",
                "nro_serie" => "07201113000227",
                "codigo" => "2387",
                "talle_id" => 7,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SALOMON",
                "modelo" => "TEAM JR",
                "nro_serie" => "103669137",
                "codigo" => "2388",
                "talle_id" => 5,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "LAMAR",
                "modelo" => "ESSENCE",
                "nro_serie" => "04201114800223",
                "codigo" => "2389",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "RTX",
                "nro_serie" => "120662670",
                "codigo" => "0514",
                "talle_id" => 9,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "ELEVATE RTX",
                "nro_serie" => "120617332",
                "codigo" => "0515",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "ELEVATE RTX",
                "nro_serie" => "120612639",
                "codigo" => "0518",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "ELEVATE RTX",
                "nro_serie" => "120612654",
                "codigo" => "0519",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "ELEVATE RTX",
                "nro_serie" => "120612630",
                "codigo" => "0520",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "ELEVATE RTX",
                "nro_serie" => "120612646",
                "codigo" => "0521",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "RACE TI",
                "nro_serie" => "119225897",
                "codigo" => "0522",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "RACE TI",
                "nro_serie" => "119227009",
                "codigo" => "0523",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "RACE TI",
                "nro_serie" => "119225903",
                "codigo" => "0524",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "RACE TI",
                "nro_serie" => "119225914",
                "codigo" => "0525",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "RACE TI",
                "nro_serie" => "119229675",
                "codigo" => "0526",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "RACE TI",
                "nro_serie" => "119225907",
                "codigo" => "0527",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "RACE TI",
                "nro_serie" => "119225921",
                "codigo" => "0528",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "RACE TI",
                "nro_serie" => "119225896",
                "codigo" => "0529",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "RACE TI",
                "nro_serie" => "119225915",
                "codigo" => "0531",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "RACE TI",
                "nro_serie" => "119225904",
                "codigo" => "0532",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "RACE TI",
                "nro_serie" => "119226692",
                "codigo" => "0533",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "RACE TI",
                "nro_serie" => "119195156",
                "codigo" => "0534",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "RACE TI",
                "nro_serie" => "119195166",
                "codigo" => "0535",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "RTX",
                "nro_serie" => "120675868",
                "codigo" => "0536",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "RTX",
                "nro_serie" => "120673073",
                "codigo" => "0537",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "RTX",
                "nro_serie" => "120671991",
                "codigo" => "0538",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "RTX",
                "nro_serie" => "120671982",
                "codigo" => "0539",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "RTX",
                "nro_serie" => "120675874",
                "codigo" => "0540",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "RTX",
                "nro_serie" => "120671990",
                "codigo" => "0541",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "RTX",
                "nro_serie" => "120675867",
                "codigo" => "0542",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "WCR-B",
                "nro_serie" => "120609120",
                "codigo" => "0543",
                "talle_id" => 9,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "WCR-B",
                "nro_serie" => "120589502",
                "codigo" => "0544",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "WCR-B",
                "nro_serie" => "120583462",
                "codigo" => "0545",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "ALIGHT 7.7",
                "nro_serie" => "218925106",
                "codigo" => "0546",
                "talle_id" => 18,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "XCR ROJO",
                "nro_serie" => "119009190",
                "codigo" => "0547",
                "talle_id" => 9,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "XCR ROJO",
                "nro_serie" => "218035690",
                "codigo" => "0548",
                "talle_id" => 22,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "XCR ROJO",
                "nro_serie" => "218998231",
                "codigo" => "0549",
                "talle_id" => 22,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "XCR ROJO",
                "nro_serie" => "119019155",
                "codigo" => "0550",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "XCR ROJO",
                "nro_serie" => "218969024",
                "codigo" => "0551",
                "talle_id" => 18,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "XCR ROJO",
                "nro_serie" => "218003106",
                "codigo" => "0552",
                "talle_id" => 18,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "XCR ROJO",
                "nro_serie" => "218903710",
                "codigo" => "0553",
                "talle_id" => 18,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "RTX RACE",
                "nro_serie" => "119205703",
                "codigo" => "0554",
                "talle_id" => 23,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "RTX RACE",
                "nro_serie" => "119205699",
                "codigo" => "0555",
                "talle_id" => 23,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "RTX RACE",
                "nro_serie" => "218039199",
                "codigo" => "0556",
                "talle_id" => 18,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "RTX RACE",
                "nro_serie" => "119213984",
                "codigo" => "0557",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "RTX RACE",
                "nro_serie" => "118982516",
                "codigo" => "0558",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "RTX RACE",
                "nro_serie" => "119202720",
                "codigo" => "0559",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "RTX RACE",
                "nro_serie" => "119202723",
                "codigo" => "0560",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "RTX RACE",
                "nro_serie" => "119202721",
                "codigo" => "0561",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "RTX",
                "nro_serie" => "119538877",
                "codigo" => "0563",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "RTX",
                "nro_serie" => "119538432",
                "codigo" => "0564",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "RTX",
                "nro_serie" => "119538448",
                "codigo" => "0565",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "RTX",
                "nro_serie" => "119538440",
                "codigo" => "0566",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "RTX",
                "nro_serie" => "120618939",
                "codigo" => "0567",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "RTX",
                "nro_serie" => "120618945",
                "codigo" => "0568",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "RTX",
                "nro_serie" => "120618941",
                "codigo" => "0569",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "RTX",
                "nro_serie" => "120657746",
                "codigo" => "0570",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "RTX",
                "nro_serie" => "120619032",
                "codigo" => "0571",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "RTX",
                "nro_serie" => "120618942",
                "codigo" => "0572",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "RTX",
                "nro_serie" => "120619048",
                "codigo" => "0573",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "RTX",
                "nro_serie" => "120618954",
                "codigo" => "0574",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "XCR AMARILLO",
                "nro_serie" => "119022756",
                "codigo" => "0575",
                "talle_id" => 9,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "XCR AMARILLO",
                "nro_serie" => "119022752",
                "codigo" => "0576",
                "talle_id" => 9,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "XCR AMARILLO",
                "nro_serie" => "119022751",
                "codigo" => "0577",
                "talle_id" => 9,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "XCR AMARILLO",
                "nro_serie" => "119027075",
                "codigo" => "0578",
                "talle_id" => 18,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "XCR AMARILLO",
                "nro_serie" => "119027092",
                "codigo" => "0579",
                "talle_id" => 18,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "XCR AMARILLO",
                "nro_serie" => "119027074",
                "codigo" => "0580",
                "talle_id" => 18,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "XCR AMARILLO",
                "nro_serie" => "119027091",
                "codigo" => "0582",
                "talle_id" => 18,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "QUATTRO 7.2 BLANCA",
                "nro_serie" => "115911119",
                "codigo" => "0583",
                "talle_id" => 18,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "FIREBIRD",
                "nro_serie" => "120589700",
                "codigo" => "0585",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "FIREBIRD",
                "nro_serie" => "120588769",
                "codigo" => "0587",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "ELEVATE RTX",
                "nro_serie" => "120617300",
                "codigo" => "0589",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "QUATTRO 7.2 BLANCA",
                "nro_serie" => "115916700",
                "codigo" => "0590",
                "talle_id" => 18,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "QUATTRO 7.2 BLANCA",
                "nro_serie" => "115911266",
                "codigo" => "0591",
                "talle_id" => 18,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "WCR-AN",
                "nro_serie" => "217663547",
                "codigo" => "0593",
                "talle_id" => 18,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "WCR-AN",
                "nro_serie" => "217589340",
                "codigo" => "0594",
                "talle_id" => 18,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "QUATTRO 8.0",
                "nro_serie" => "218891682",
                "codigo" => "0596",
                "talle_id" => 21,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "QUATTRO 8.0",
                "nro_serie" => "181446702",
                "codigo" => "0597",
                "talle_id" => 21,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "QUATTRO 7.4",
                "nro_serie" => "218036356",
                "codigo" => "0598",
                "talle_id" => 21,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "WCR-N",
                "nro_serie" => "217710231",
                "codigo" => "0599",
                "talle_id" => 18,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "WCR-N",
                "nro_serie" => "218040391",
                "codigo" => "0601",
                "talle_id" => 18,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "WCR-A",
                "nro_serie" => "218903709",
                "codigo" => "0603",
                "talle_id" => 18,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "WCR-A",
                "nro_serie" => "218927816",
                "codigo" => "0604",
                "talle_id" => 18,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA 80",
                "nro_serie" => "54612204",
                "codigo" => "0605",
                "talle_id" => 13,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA 80",
                "nro_serie" => "53910812",
                "codigo" => "0606",
                "talle_id" => 14,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA 80",
                "nro_serie" => "53910806",
                "codigo" => "0607",
                "talle_id" => 14,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA 80",
                "nro_serie" => "53714476",
                "codigo" => "0608",
                "talle_id" => 21,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA 80",
                "nro_serie" => "53714474",
                "codigo" => "0609",
                "talle_id" => 21,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "PROGRESSOR XTRS",
                "nro_serie" => "52013543",
                "codigo" => "0610",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "PROGRESSOR XTRS",
                "nro_serie" => "52313564",
                "codigo" => "0611",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "PROGRESSOR XTRS",
                "nro_serie" => "52313544",
                "codigo" => "0612",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "PROGRESSOR XTRS",
                "nro_serie" => "52313547",
                "codigo" => "0613",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "PROGRESSOR XTRS",
                "nro_serie" => "52313545",
                "codigo" => "0614",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "PROGRESSOR XTRS",
                "nro_serie" => "52313562",
                "codigo" => "0615",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "PROGRESSOR XTRS",
                "nro_serie" => "52613560",
                "codigo" => "0616",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "PROGRESSOR XTRS",
                "nro_serie" => "52313530",
                "codigo" => "0617",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "PROGRESSOR XTRS",
                "nro_serie" => "52313559",
                "codigo" => "0618",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "PROGRESSOR XTRS",
                "nro_serie" => "52313558",
                "codigo" => "0619",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "PROGRESSOR XTRS",
                "nro_serie" => "52313557",
                "codigo" => "0620",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "WCR-A",
                "nro_serie" => "218925904",
                "codigo" => "0621",
                "talle_id" => 18,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR PRO MT X",
                "nro_serie" => "84812076",
                "codigo" => "0622",
                "talle_id" => 21,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY JR",
                "nro_serie" => "1807170",
                "codigo" => "0633",
                "talle_id" => 4,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY JR",
                "nro_serie" => "1807171",
                "codigo" => "0634",
                "talle_id" => 4,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY JR",
                "nro_serie" => "1807178",
                "codigo" => "0635",
                "talle_id" => 4,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY JR",
                "nro_serie" => "1807179",
                "codigo" => "0636",
                "talle_id" => 4,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2121588",
                "codigo" => "0629",
                "talle_id" => 8,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2121589",
                "codigo" => "0630",
                "talle_id" => 8,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2121587",
                "codigo" => "0631",
                "talle_id" => 8,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2121590",
                "codigo" => "0632",
                "talle_id" => 8,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "1793090",
                "codigo" => "0637",
                "talle_id" => 2,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "1793078",
                "codigo" => "0638",
                "talle_id" => 2,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "1793080",
                "codigo" => "0639",
                "talle_id" => 2,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "1793081",
                "codigo" => "0640",
                "talle_id" => 2,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2118214",
                "codigo" => "0641",
                "talle_id" => 58,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2118202",
                "codigo" => "0642",
                "talle_id" => 58,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2118196",
                "codigo" => "0643",
                "talle_id" => 58,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2118187",
                "codigo" => "0644",
                "talle_id" => 58,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2107718",
                "codigo" => "0645",
                "talle_id" => 6,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2107706",
                "codigo" => "0646",
                "talle_id" => 6,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2107720",
                "codigo" => "0647",
                "talle_id" => 6,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2107716",
                "codigo" => "0648",
                "talle_id" => 6,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2107717",
                "codigo" => "0649",
                "talle_id" => 6,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "1793079",
                "codigo" => "0650",
                "talle_id" => 2,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY JR",
                "nro_serie" => "1807173",
                "codigo" => "0651",
                "talle_id" => 4,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2112839",
                "codigo" => "0652",
                "talle_id" => 8,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2117037",
                "codigo" => "0653",
                "talle_id" => 9,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2117012",
                "codigo" => "0654",
                "talle_id" => 9,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2117017",
                "codigo" => "0655",
                "talle_id" => 9,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2117033",
                "codigo" => "0656",
                "talle_id" => 9,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2117031",
                "codigo" => "0657",
                "talle_id" => 9,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2117029",
                "codigo" => "0658",
                "talle_id" => 9,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2117042",
                "codigo" => "0659",
                "talle_id" => 9,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2119513",
                "codigo" => "0662",
                "talle_id" => 13,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2119503",
                "codigo" => "0663",
                "talle_id" => 13,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2121683",
                "codigo" => "0664",
                "talle_id" => 13,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2121686",
                "codigo" => "0665",
                "talle_id" => 13,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2119519",
                "codigo" => "0666",
                "talle_id" => 13,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2119526",
                "codigo" => "0667",
                "talle_id" => 13,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2119512",
                "codigo" => "0668",
                "talle_id" => 13,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2119531",
                "codigo" => "0669",
                "talle_id" => 13,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2117340",
                "codigo" => "0670",
                "talle_id" => 14,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2117378",
                "codigo" => "0672",
                "talle_id" => 14,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2117377",
                "codigo" => "0673",
                "talle_id" => 14,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2121092",
                "codigo" => "0674",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2117090",
                "codigo" => "0675",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2121089",
                "codigo" => "0676",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2121093",
                "codigo" => "0677",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2117022",
                "codigo" => "0678",
                "talle_id" => 9,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2117028",
                "codigo" => "0679",
                "talle_id" => 9,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2117021",
                "codigo" => "0680",
                "talle_id" => 9,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => " 2117001",
                "codigo" => "0681",
                "talle_id" => 9,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE 80 XTR NEGRO",
                "nro_serie" => "53510717",
                "codigo" => "0682",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "WCR-N",
                "nro_serie" => "218978748",
                "codigo" => "0683",
                "talle_id" => 18,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA 75",
                "nro_serie" => "54010177",
                "codigo" => "0684",
                "talle_id" => 10,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "WCR-A",
                "nro_serie" => "217707232",
                "codigo" => "0685",
                "talle_id" => 18,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "QUATTRO7.7",
                "nro_serie" => "115925165",
                "codigo" => "0686",
                "talle_id" => 21,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "ELEVATE RTX",
                "nro_serie" => "120666060",
                "codigo" => "0687",
                "talle_id" => 9,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "RTX",
                "nro_serie" => "120673226",
                "codigo" => "0688",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RACE",
                "nro_serie" => "00512975",
                "codigo" => "0689",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE 80 XTR NEGRO",
                "nro_serie" => "53510677",
                "codigo" => "0690",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "WCR-A",
                "nro_serie" => "218926535",
                "codigo" => "0691",
                "talle_id" => 18,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "FIREBIRD JR",
                "nro_serie" => "120652330",
                "codigo" => "0692",
                "talle_id" => 7,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA 75",
                "nro_serie" => "53915378",
                "codigo" => "0699",
                "talle_id" => 13,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "ELEVATE RTX",
                "nro_serie" => "120617299",
                "codigo" => "0700",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RACE",
                "nro_serie" => "00313307",
                "codigo" => "0701",
                "talle_id" => 21,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "FIREBIRD JR",
                "nro_serie" => "120652373",
                "codigo" => "0702",
                "talle_id" => 7,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "BULLETPROOF XTR ",
                "nro_serie" => "24121043",
                "codigo" => "0711",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "WCR-N",
                "nro_serie" => "218042630",
                "codigo" => "0713",
                "talle_id" => 18,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "BULLETPROOF XTR ",
                "nro_serie" => "24121060",
                "codigo" => "0715",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "BULLETPROOF XTR ",
                "nro_serie" => "31020419",
                "codigo" => "0716",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "BULLETPROOF XTR ",
                "nro_serie" => "24121052",
                "codigo" => "0717",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RACE ONE JR",
                "nro_serie" => "94110939",
                "codigo" => "0718",
                "talle_id" => 7,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "BULLETPROOF XTR ",
                "nro_serie" => "24121073",
                "codigo" => "0720",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "BULLETPROOF XTR ",
                "nro_serie" => "31020427",
                "codigo" => "0721",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "BULLETPROOF XTR ",
                "nro_serie" => "24121071",
                "codigo" => "0722",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "NITRO",
                "modelo" => "BEAST BOSQUE",
                "nro_serie" => "18080966",
                "codigo" => "0726",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "MYSTIQUE CELESTE",
                "nro_serie" => "18300002",
                "codigo" => "0727",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "PRIME WIDE",
                "nro_serie" => "19360936",
                "codigo" => "0727",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "LAMAR",
                "modelo" => "VIPER",
                "nro_serie" => "05201115100140",
                "codigo" => "0728",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "FIREBIRD JR",
                "nro_serie" => "119532987",
                "codigo" => "0731",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "RACE TI",
                "nro_serie" => "119225908",
                "codigo" => "0732",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "QUATTRO 7.2 PINK",
                "nro_serie" => "116984050",
                "codigo" => "0733",
                "talle_id" => 18,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "KOA JR",
                "nro_serie" => "54311055",
                "codigo" => "0736",
                "talle_id" => 1,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "PROGRESSOR JR",
                "nro_serie" => "21713418",
                "codigo" => "0830",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "PROGRESSOR JR",
                "nro_serie" => "04414945",
                "codigo" => "0737",
                "talle_id" => 1,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "ELEVATE RTX",
                "nro_serie" => "120817340",
                "codigo" => "0737",
                "talle_id" => 9,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "LAMAR",
                "modelo" => "ESSENCE",
                "nro_serie" => "201115100814",
                "codigo" => "0738",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLEX 4D",
                "nro_serie" => "1868625",
                "codigo" => "0740",
                "talle_id" => 18,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLEX 4D",
                "nro_serie" => "1868463",
                "codigo" => "0741",
                "talle_id" => 18,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLEX 4D",
                "nro_serie" => "1868439",
                "codigo" => "0742",
                "talle_id" => 18,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "LAMAR",
                "modelo" => "TROOPER",
                "nro_serie" => "08201115700626",
                "codigo" => "0743",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NITRO",
                "modelo" => "ARIAL",
                "nro_serie" => "17081195",
                "codigo" => "0744",
                "talle_id" => 9,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "LAMAR",
                "modelo" => "VIPER",
                "nro_serie" => "05201115100177",
                "codigo" => "0746",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "LTD",
                "modelo" => "VENOM",
                "nro_serie" => "03201215100018",
                "codigo" => "0747",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "LAMAR",
                "modelo" => "ESSENCE",
                "nro_serie" => "04201114800223",
                "codigo" => "0746",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RC ONE JR",
                "nro_serie" => "94110932",
                "codigo" => "0753",
                "talle_id" => 7,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RC4 RACE",
                "nro_serie" => "34413942",
                "codigo" => "0754",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "FIREBIRD JR",
                "nro_serie" => "119018032",
                "codigo" => "0756",
                "talle_id" => 55,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "ROSSIGNOL",
                "modelo" => "CONTRAST",
                "nro_serie" => "8271565",
                "codigo" => "0757",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "LAMAR",
                "modelo" => "PIXE",
                "nro_serie" => "12201114100257",
                "codigo" => "2472",
                "talle_id" => 9,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "LTD",
                "modelo" => "RAIDER",
                "nro_serie" => "08201115600970",
                "codigo" => "0758",
                "talle_id" => 8,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "LTD",
                "modelo" => "RAIDER",
                "nro_serie" => "08201113001192",
                "codigo" => "0759",
                "talle_id" => 8,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "WCR-AN",
                "nro_serie" => "217701019",
                "codigo" => "0887",
                "talle_id" => 18,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RACE JR",
                "nro_serie" => "53310978",
                "codigo" => "0760",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "FIREBIRD JR",
                "nro_serie" => "119532918",
                "codigo" => "0761",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "NITRO",
                "modelo" => "FUSION BLANCA",
                "nro_serie" => "18500003",
                "codigo" => "2390",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE E-TITAN ",
                "nro_serie" => "1697493",
                "codigo" => "0770",
                "talle_id" => 14,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE E-TITAN ",
                "nro_serie" => "1667638",
                "codigo" => "0771",
                "talle_id" => 14,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE E-TITAN ",
                "nro_serie" => "2031500",
                "codigo" => "0772",
                "talle_id" => 21,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE E-TITAN ",
                "nro_serie" => "2011234",
                "codigo" => "0978",
                "talle_id" => 18,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE E-TITAN ",
                "nro_serie" => "2097727",
                "codigo" => "0773",
                "talle_id" => 23,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE E-TITAN ",
                "nro_serie" => "2093914",
                "codigo" => "0774",
                "talle_id" => 23,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE E-TITAN ",
                "nro_serie" => "2090768",
                "codigo" => "0775",
                "talle_id" => 23,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE E-TITAN ",
                "nro_serie" => "2011532",
                "codigo" => "0776",
                "talle_id" => 18,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE E-TITAN ",
                "nro_serie" => "2012239",
                "codigo" => "0777",
                "talle_id" => 18,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE E-TITAN ",
                "nro_serie" => "2011382",
                "codigo" => "0778",
                "talle_id" => 18,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLEX 4D",
                "nro_serie" => "1868617",
                "codigo" => "2391",
                "talle_id" => 18,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLEX 4D",
                "nro_serie" => "1868451",
                "codigo" => "2392",
                "talle_id" => 18,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLEX 4D",
                "nro_serie" => "1868622",
                "codigo" => "2393",
                "talle_id" => 18,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "WCR-N",
                "nro_serie" => "218040394",
                "codigo" => "0880",
                "talle_id" => 18,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "XCR AMARILLO",
                "nro_serie" => "119027093",
                "codigo" => "0881",
                "talle_id" => 18,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RACE",
                "nro_serie" => "00513013",
                "codigo" => "0882",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RACE",
                "nro_serie" => "00512976",
                "codigo" => "0883",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CRUZAR SPEED XTR",
                "nro_serie" => "52414330",
                "codigo" => "0888",
                "talle_id" => 17,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "NITRO",
                "modelo" => "MYSTIQUE CELESTE",
                "nro_serie" => "18291302",
                "codigo" => "2394",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "TECHNINE",
                "modelo" => "GREEN LIGHT BLUE WMN",
                "nro_serie" => "20121702B1500003",
                "codigo" => "2395",
                "talle_id" => 10,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "KEMPER",
                "modelo" => "DIVA",
                "nro_serie" => "Diva1",
                "codigo" => "2400",
                "talle_id" => 9,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "KEMPER",
                "modelo" => "DIVA",
                "nro_serie" => "Diva2",
                "codigo" => "2401",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "KEMPER",
                "modelo" => "DIVA",
                "nro_serie" => "Diva3",
                "codigo" => "2402",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "KEMPER",
                "modelo" => "DIVA",
                "nro_serie" => "Diva5",
                "codigo" => "2403",
                "talle_id" => 9,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "FORUM",
                "modelo" => "CHILLY DOG",
                "nro_serie" => "187800015",
                "codigo" => "2404",
                "talle_id" => 8,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "KEMPER",
                "modelo" => "DIVA",
                "nro_serie" => "Diva7",
                "codigo" => "2404",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "KEMPER",
                "modelo" => "DIVA",
                "nro_serie" => "Diva6",
                "codigo" => "2405",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "KEMPER",
                "modelo" => "DIVA",
                "nro_serie" => "Diva8",
                "codigo" => "2407",
                "talle_id" => 9,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "KEMPER",
                "modelo" => "DIVA",
                "nro_serie" => "Diva9",
                "codigo" => "2408",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "FIFTY ONE",
                "modelo" => "SHOOTER",
                "nro_serie" => "12317398",
                "codigo" => "2409",
                "talle_id" => 9,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLEX 4D",
                "nro_serie" => "1395990",
                "codigo" => "2410",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLEX 4D",
                "nro_serie" => "1395992",
                "codigo" => "2411",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLEX 4D",
                "nro_serie" => "1395988",
                "codigo" => "2412",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLEX 4D",
                "nro_serie" => "1380156",
                "codigo" => "2413",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLEX 4D",
                "nro_serie" => "1379036",
                "codigo" => "2414",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLEX 4D",
                "nro_serie" => "1387027",
                "codigo" => "2415",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLEX 4D",
                "nro_serie" => "1367940",
                "codigo" => "2416",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLEX 4D",
                "nro_serie" => "1391256",
                "codigo" => "2417",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2119518",
                "codigo" => "0779",
                "talle_id" => 13,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2119520",
                "codigo" => "0780",
                "talle_id" => 13,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2119529",
                "codigo" => "0781",
                "talle_id" => 13,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2121682",
                "codigo" => "0782",
                "talle_id" => 13,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2117091",
                "codigo" => "0783",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2117092",
                "codigo" => "0784",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2121091",
                "codigo" => "0785",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2121087",
                "codigo" => "0786",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2117374",
                "codigo" => "0787",
                "talle_id" => 14,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2117375",
                "codigo" => "0788",
                "talle_id" => 14,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2117357",
                "codigo" => "0789",
                "talle_id" => 14,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2117360",
                "codigo" => "0790",
                "talle_id" => 14,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2117004",
                "codigo" => "0791",
                "talle_id" => 9,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLEX 4D",
                "nro_serie" => "1391228",
                "codigo" => "2418",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLEX 4D",
                "nro_serie" => "1391253",
                "codigo" => "2419",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLEX 4D",
                "nro_serie" => "1392541",
                "codigo" => "2420",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLEX 4D",
                "nro_serie" => "1868479",
                "codigo" => "2421",
                "talle_id" => 18,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLEX 4D",
                "nro_serie" => "1853055",
                "codigo" => "2422",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLEX 4D",
                "nro_serie" => "1376944",
                "codigo" => "2423",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLEX 4D",
                "nro_serie" => "1375094",
                "codigo" => "2424",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2119535",
                "codigo" => "0792",
                "talle_id" => 13,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2119527",
                "codigo" => "0793",
                "talle_id" => 13,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2119537",
                "codigo" => "0794",
                "talle_id" => 13,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2121687",
                "codigo" => "0795",
                "talle_id" => 13,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2117352",
                "codigo" => "0796",
                "talle_id" => 14,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2117348",
                "codigo" => "0797",
                "talle_id" => 14,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2118192",
                "codigo" => "0798",
                "talle_id" => 58,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CURV JR",
                "nro_serie" => "94215430",
                "codigo" => "0799",
                "talle_id" => 57,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CURV JR",
                "nro_serie" => "94215429",
                "codigo" => "0800",
                "talle_id" => 57,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CURV JR",
                "nro_serie" => "94415295",
                "codigo" => "0801",
                "talle_id" => 1,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CURV JR",
                "nro_serie" => "94415314",
                "codigo" => "0802",
                "talle_id" => 1,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "CURV JR",
                "nro_serie" => "94415299",
                "codigo" => "0803",
                "talle_id" => 1,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RACE ONE JR",
                "nro_serie" => "94110931",
                "codigo" => "0804",
                "talle_id" => 7,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RACE ONE JR",
                "nro_serie" => "94114461",
                "codigo" => "0805",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RACE ONE JR",
                "nro_serie" => "94114460",
                "codigo" => "0806",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RACE ONE JR",
                "nro_serie" => "94114456",
                "codigo" => "0807",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RACE ONE JR",
                "nro_serie" => "94115528",
                "codigo" => "0808",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RACE ONE JR",
                "nro_serie" => "94116018",
                "codigo" => "0809",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RACE ONE JR",
                "nro_serie" => "94116017",
                "codigo" => "0810",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RACE ONE JR",
                "nro_serie" => "94114459",
                "codigo" => "0811",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RACE ONE JR",
                "nro_serie" => "94116015",
                "codigo" => "0812",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RACE ONE JR PINK",
                "nro_serie" => "125003728",
                "codigo" => "0829",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RACE ONE JR PINK",
                "nro_serie" => "123003121",
                "codigo" => "0813",
                "talle_id" => 7,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RACE ONE JR PINK",
                "nro_serie" => "125003878",
                "codigo" => "0814",
                "talle_id" => 7,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RACE ONE JR PINK",
                "nro_serie" => "123003132",
                "codigo" => "0815",
                "talle_id" => 7,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RACE ONE JR PINK",
                "nro_serie" => "123003095",
                "codigo" => "0816",
                "talle_id" => 7,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RACE ONE JR PINK",
                "nro_serie" => "123003091",
                "codigo" => "0817",
                "talle_id" => 7,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RACE ONE JR PINK",
                "nro_serie" => "123003113",
                "codigo" => "0818",
                "talle_id" => 7,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RACE ONE JR PINK",
                "nro_serie" => "123003090",
                "codigo" => "0819",
                "talle_id" => 7,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RACE ONE JR PINK",
                "nro_serie" => "124003398",
                "codigo" => "0820",
                "talle_id" => 7,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "EUROPA PARK",
                "nro_serie" => "91615388",
                "codigo" => "0821",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "EUROPA PARK",
                "nro_serie" => "91615348",
                "codigo" => "0822",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "EUROPA PARK",
                "nro_serie" => "91615377",
                "codigo" => "0823",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "EUROPA PARK",
                "nro_serie" => "91615376",
                "codigo" => "0824",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "EUROPA PARK",
                "nro_serie" => "91615378",
                "codigo" => "0825",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "EUROPA PARK",
                "nro_serie" => "91615389",
                "codigo" => "0826",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "EUROPA PARK",
                "nro_serie" => "91615381",
                "codigo" => "0827",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "EUROPA PARK",
                "nro_serie" => "91615380",
                "codigo" => "0828",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2117025",
                "codigo" => "0831",
                "talle_id" => 9,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2117024",
                "codigo" => "0832",
                "talle_id" => 9,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2117027",
                "codigo" => "0833",
                "talle_id" => 9,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2117016",
                "codigo" => "0834",
                "talle_id" => 9,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2117035",
                "codigo" => "0835",
                "talle_id" => 9,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2117010",
                "codigo" => "0836",
                "talle_id" => 9,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2117036",
                "codigo" => "0837",
                "talle_id" => 9,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2117011",
                "codigo" => "0838",
                "talle_id" => 9,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2117026",
                "codigo" => "0839",
                "talle_id" => 9,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2117015",
                "codigo" => "0840",
                "talle_id" => 9,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2113473",
                "codigo" => "0841",
                "talle_id" => 9,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2117350",
                "codigo" => "0842",
                "talle_id" => 14,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2117354",
                "codigo" => "0843",
                "talle_id" => 14,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2117358",
                "codigo" => "0844",
                "talle_id" => 14,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2117093",
                "codigo" => "0846",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2117100",
                "codigo" => "0847",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2117356",
                "codigo" => "0848",
                "talle_id" => 14,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2121099",
                "codigo" => "0849",
                "talle_id" => 14,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2117353",
                "codigo" => "0850",
                "talle_id" => 14,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2117359",
                "codigo" => "0851",
                "talle_id" => 14,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2117349",
                "codigo" => "0852",
                "talle_id" => 14,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2121096",
                "codigo" => "0853",
                "talle_id" => 14,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "BULLETPROOF XTR ",
                "nro_serie" => "24121055",
                "codigo" => "0854",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "BULLETPROOF XTR ",
                "nro_serie" => "24121049",
                "codigo" => "0855",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2121688",
                "codigo" => "0856",
                "talle_id" => 13,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2119506",
                "codigo" => "0857",
                "talle_id" => 13,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2121685",
                "codigo" => "0858",
                "talle_id" => 13,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2121689",
                "codigo" => "0859",
                "talle_id" => 13,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2119539",
                "codigo" => "0860",
                "talle_id" => 13,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2119514",
                "codigo" => "0861",
                "talle_id" => 13,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2119536",
                "codigo" => "0862",
                "talle_id" => 13,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2119533",
                "codigo" => "0863",
                "talle_id" => 13,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2119524",
                "codigo" => "0864",
                "talle_id" => 13,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2117030",
                "codigo" => "0884",
                "talle_id" => 9,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "BRILLIANT MTN ",
                "nro_serie" => "74812975",
                "codigo" => "0885",
                "talle_id" => 23,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RACE",
                "nro_serie" => "44212392",
                "codigo" => "0886",
                "talle_id" => 1,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR MOTIVE BLANCO-MARRON",
                "nro_serie" => "12514881",
                "codigo" => "0889",
                "talle_id" => 21,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR MOTIVE BLANCO-MARRON",
                "nro_serie" => "12516555",
                "codigo" => "0890",
                "talle_id" => 23,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "WORLDCUP BLANCA",
                "nro_serie" => "20721418",
                "codigo" => "0891",
                "talle_id" => 23,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "BLIZZARD",
                "modelo" => "IQ RC",
                "nro_serie" => "116510022",
                "codigo" => "0892",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "NITRO",
                "modelo" => "VICTORIA",
                "nro_serie" => "15310941",
                "codigo" => "2102",
                "talle_id" => 14,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "NITRO",
                "modelo" => "VICTORIA",
                "nro_serie" => "15310941",
                "codigo" => "2425",
                "talle_id" => 14,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "LTD ",
                "modelo" => "MFG - WHITE & PINK ",
                "nro_serie" => "08201100146",
                "codigo" => "2426",
                "talle_id" => 9,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "MORROW",
                "modelo" => "LOTUS ",
                "nro_serie" => "8226542",
                "codigo" => "2427",
                "talle_id" => 14,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "MORROW",
                "modelo" => "LOTUS ",
                "nro_serie" => "8233061",
                "codigo" => "2428",
                "talle_id" => 14,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "MORROW",
                "modelo" => "LOTUS ",
                "nro_serie" => "8230027",
                "codigo" => "2429",
                "talle_id" => 14,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "MORROW",
                "modelo" => "LOTUS ",
                "nro_serie" => "8230046",
                "codigo" => "2430",
                "talle_id" => 14,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "MORROW",
                "modelo" => "LOTUS ",
                "nro_serie" => "8226508",
                "codigo" => "2431",
                "talle_id" => 14,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "NITRO",
                "modelo" => "STANCE NSBC ",
                "nro_serie" => "17391238",
                "codigo" => "2432",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "KEMPER",
                "modelo" => "DIVA",
                "nro_serie" => "DIVA 10",
                "codigo" => "2433",
                "talle_id" => 9,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "KEMPER",
                "modelo" => "DIVA",
                "nro_serie" => "DIVA 11",
                "codigo" => "2434",
                "talle_id" => 9,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "KEMPER",
                "modelo" => "DIVA",
                "nro_serie" => "DIVA 12",
                "codigo" => "2435",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "KEMPER",
                "modelo" => "DIVA",
                "nro_serie" => "DIVA 13",
                "codigo" => "2436",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "KEMPER",
                "modelo" => "DIVA",
                "nro_serie" => "DIVA14",
                "codigo" => "2437",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "KEMPER",
                "modelo" => "DIVA",
                "nro_serie" => "DIVA 15",
                "codigo" => "2438",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "KEMPER",
                "modelo" => "DIVA",
                "nro_serie" => "DIVA 16",
                "codigo" => "2439",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "DC",
                "modelo" => "PLY",
                "nro_serie" => "1000404665",
                "codigo" => "2440",
                "talle_id" => 10,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "GNU",
                "modelo" => "CARBON CREDITS SERIES",
                "nro_serie" => "7823892",
                "codigo" => "2441",
                "talle_id" => 17,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "MORROW",
                "modelo" => "LOTUS ",
                "nro_serie" => "8230043",
                "codigo" => "2443",
                "talle_id" => 14,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "KEMPER",
                "modelo" => "DIVA",
                "nro_serie" => "DIVA 17",
                "codigo" => "2444",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "KEMPER",
                "modelo" => "DIVA",
                "nro_serie" => "DIVA 18",
                "codigo" => "2445",
                "talle_id" => 9,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "KEMPER",
                "modelo" => "DIVA",
                "nro_serie" => "DIVA 19",
                "codigo" => "2446",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "STUNNER APPLE GREEN & LIGHT BLUE",
                "nro_serie" => "33425208",
                "codigo" => "0893",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "STUNNER APPLE GREEN & LIGHT BLUE",
                "nro_serie" => "33415158",
                "codigo" => "0894",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "STUNNER APPLE GREEN & LIGHT BLUE",
                "nro_serie" => "34012083",
                "codigo" => "0895",
                "talle_id" => 1,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "STUNNER APPLE GREEN & LIGHT BLUE",
                "nro_serie" => "33810927",
                "codigo" => "0896",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "STUNNER BLACK & YELLOW ",
                "nro_serie" => "14116519",
                "codigo" => "0897",
                "talle_id" => 7,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "ADDICT TEAM ",
                "nro_serie" => "04580248",
                "codigo" => "0898",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "ADDICT TEAM ",
                "nro_serie" => "14014818",
                "codigo" => "0899",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "PRODIGY  -  VIOLETA NEGRO & AMARILLO",
                "nro_serie" => "21514224",
                "codigo" => "0900",
                "talle_id" => 14,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "PRODIGY - BLANCO AZUL & NARANJA ",
                "nro_serie" => "44514213",
                "codigo" => "0901",
                "talle_id" => 14,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RANGER JR FREERIDE - VERDE Y  NEGRO ",
                "nro_serie" => "53912750",
                "codigo" => "0902",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RANGER JR FREERIDE - VERDE Y  NEGRO ",
                "nro_serie" => "53912749",
                "codigo" => "0903",
                "talle_id" => 18,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RANGER JR FREERIDE - VERDE Y  NEGRO ",
                "nro_serie" => "53810973",
                "codigo" => "0904",
                "talle_id" => 13,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RANGER  FREERIDE 84- VERDE Y  NEGRO ",
                "nro_serie" => "51612806",
                "codigo" => "0905",
                "talle_id" => 21,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RANGER FREERIDE 84  - VERDE Y  NEGRO ",
                "nro_serie" => "33813617",
                "codigo" => "0906",
                "talle_id" => 17,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RANGER FREERIDE 84  - VERDE Y  NEGRO ",
                "nro_serie" => "53813619",
                "codigo" => "0907",
                "talle_id" => 17,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RANGER FREERIDE 98 - VERDE Y  NEGRO ",
                "nro_serie" => "54611199",
                "codigo" => "0908",
                "talle_id" => 26,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RANGER 98 FREERIDE - VERDE Y  NEGRO ",
                "nro_serie" => "54611200",
                "codigo" => "0909",
                "talle_id" => 26,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RANGER 98 FREERIDE - VERDE Y  NEGRO ",
                "nro_serie" => "54611201",
                "codigo" => "0910",
                "talle_id" => 26,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RANGER JR FREERIDE - VERDE Y  NEGRO ",
                "nro_serie" => "53810969",
                "codigo" => "0911",
                "talle_id" => 13,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RANGER JR FREERIDE - VERDE Y  NEGRO ",
                "nro_serie" => "53613819",
                "codigo" => "0912",
                "talle_id" => 9,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RANGER  FREERIDE 84- VERDE Y  NEGRO ",
                "nro_serie" => "51612822",
                "codigo" => "0913",
                "talle_id" => 21,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FORUM",
                "modelo" => "CHILLY DOG",
                "nro_serie" => "187800009",
                "codigo" => "2447",
                "talle_id" => 8,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "FORUM",
                "modelo" => "CHILLY DOG",
                "nro_serie" => "187800020",
                "codigo" => "2448",
                "talle_id" => 8,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "FORUM",
                "modelo" => "CHILLY DOG",
                "nro_serie" => "187800045",
                "codigo" => "2449",
                "talle_id" => 8,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "FORUM",
                "modelo" => "CHILLY DOG",
                "nro_serie" => "187800023",
                "codigo" => "2450",
                "talle_id" => 8,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "44311349",
                "codigo" => "0914",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVA",
                "nro_serie" => "43714215",
                "codigo" => "0915",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "TECHNINE ",
                "modelo" => "TEAM BOTTLES ",
                "nro_serie" => "20151802A1509H0009",
                "codigo" => "2451",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "SUPERIOR ",
                "nro_serie" => " 44611413 ",
                "codigo" => "0625   \t",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "SUPERIOR ",
                "nro_serie" => "44611434",
                "codigo" => "0626",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "SUPERIOR ",
                "nro_serie" => "45013141 ",
                "codigo" => "0627",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "SUPERIOR ",
                "nro_serie" => "45012764",
                "codigo" => "0628",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "SUPERIOR ",
                "nro_serie" => "45012862",
                "codigo" => "0712",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "SUPERIOR ",
                "nro_serie" => "45012746",
                "codigo" => "0726",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "SUPERIOR ",
                "nro_serie" => "44611404 ",
                "codigo" => "0693",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "SUPERIOR ",
                "nro_serie" => "44611410",
                "codigo" => "0706",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "SUPERIOR ",
                "nro_serie" => "44611400",
                "codigo" => "0707",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "SUPERIOR ",
                "nro_serie" => "44611399",
                "codigo" => "0708",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "SUPERIOR ",
                "nro_serie" => "44611412",
                "codigo" => "0709",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "SUPERIOR ",
                "nro_serie" => "44611403",
                "codigo" => "0879",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "SUPERIOR ",
                "nro_serie" => "43912468   \t",
                "codigo" => "0705",
                "talle_id" => 7,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "SUPERIOR ",
                "nro_serie" => "43912459",
                "codigo" => "0714",
                "talle_id" => 7,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "SUPERIOR ",
                "nro_serie" => " 43912449 ",
                "codigo" => "0723",
                "talle_id" => 7,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "SUPERIOR ",
                "nro_serie" => "44611415",
                "codigo" => "0725",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "NITRO",
                "modelo" => "RIPPER AMARILLO",
                "nro_serie" => "18340294",
                "codigo" => "2452",
                "talle_id" => 5,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "K2",
                "modelo" => "KAN BLANCO Y ROSA",
                "nro_serie" => "0050110999",
                "codigo" => "2453",
                "talle_id" => 3,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "K2",
                "modelo" => "KAN BLANCO Y ROSA",
                "nro_serie" => "0051110999",
                "codigo" => "2454",
                "talle_id" => 3,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "K2",
                "modelo" => "KAN BLANCO Y ROSA",
                "nro_serie" => "0157110999",
                "codigo" => "2455",
                "talle_id" => 3,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "K2",
                "modelo" => "KAN BLANCO Y ROSA",
                "nro_serie" => "005290999",
                "codigo" => "2456",
                "talle_id" => 57,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "K2",
                "modelo" => "KAN BLANCO Y ROSA",
                "nro_serie" => "97400999",
                "codigo" => "2457",
                "talle_id" => 1,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "HEAD",
                "modelo" => "KORE X85",
                "nro_serie" => "2099232",
                "codigo" => "0977",
                "talle_id" => 21,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "KORE X85",
                "nro_serie" => "2099893",
                "codigo" => "0916",
                "talle_id" => 21,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "KORE X85",
                "nro_serie" => "2081746",
                "codigo" => "0917",
                "talle_id" => 18,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "KORE X85",
                "nro_serie" => "2081842",
                "codigo" => "0918",
                "talle_id" => 18,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "BULLETPROOF XTR ",
                "nro_serie" => " 24121035",
                "codigo" => "0624",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE NARANJA ",
                "nro_serie" => "23810411 ",
                "codigo" => "0877",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE NARANJA ",
                "nro_serie" => "23810415",
                "codigo" => "0873",
                "talle_id" => 10,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE NARANJA ",
                "nro_serie" => "21114059",
                "codigo" => "0920",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE NARANJA ",
                "nro_serie" => "22517795",
                "codigo" => "0923",
                "talle_id" => 13,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE NARANJA ",
                "nro_serie" => "23812654",
                "codigo" => "0921",
                "talle_id" => 23,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "MOTIVE NARANJA ",
                "nro_serie" => "23812668",
                "codigo" => "0922",
                "talle_id" => 23,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "SUPERIOR RC4",
                "nro_serie" => "2413840",
                "codigo" => "0924",
                "talle_id" => 18,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "VIRON 2.2",
                "nro_serie" => "13611458",
                "codigo" => "0925",
                "talle_id" => 21,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "ESCAPE",
                "modelo" => "MILLENIUM THREE",
                "nro_serie" => "10772515800011",
                "codigo" => "0745",
                "talle_id" => 17,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JR NEMI",
                "nro_serie" => "18300823",
                "codigo" => "2459",
                "talle_id" => 4,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLEX 4D",
                "nro_serie" => "1390606",
                "codigo" => "2460",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "LTD",
                "modelo" => "DOLAR",
                "nro_serie" => "07201115700080",
                "codigo" => "2461",
                "talle_id" => 17,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SAPIENT",
                "modelo" => "ROJA",
                "nro_serie" => "40511228",
                "codigo" => "2462",
                "talle_id" => 9,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "HEAD",
                "modelo" => "CONCEPT KID JR",
                "nro_serie" => "21108982",
                "codigo" => "2462",
                "talle_id" => 57,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "LTD",
                "modelo" => "PASCED JR ",
                "nro_serie" => "08201110000148",
                "codigo" => "2463",
                "talle_id" => 1,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "HEAD",
                "modelo" => "CONCEPT KID JR GRIS",
                "nro_serie" => "11101300509",
                "codigo" => "2464",
                "talle_id" => 2,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "K2",
                "modelo" => "KAN BLANCO Y ROSA",
                "nro_serie" => "11440155110999",
                "codigo" => "2465",
                "talle_id" => 3,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "K2",
                "modelo" => "KAN BLANCO Y ROSA",
                "nro_serie" => "11440151110999",
                "codigo" => "2466",
                "talle_id" => 3,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SANTA CRUZ",
                "modelo" => " TIGER ",
                "nro_serie" => "800087419",
                "codigo" => "2467",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SANTA CRUZ",
                "modelo" => " TIGER ",
                "nro_serie" => "800089273",
                "codigo" => "2468",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SANTA CRUZ",
                "modelo" => " TIGER ",
                "nro_serie" => "800089258",
                "codigo" => "2469",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "LAMAR ",
                "modelo" => "COLORADO TROOPER ",
                "nro_serie" => "08201215100004",
                "codigo" => "2470",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SALOMON",
                "modelo" => "TEAM  VERDE JR ",
                "nro_serie" => "103669137",
                "codigo" => "2471",
                "talle_id" => 5,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SANTA CRUZ",
                "modelo" => " TIGER ",
                "nro_serie" => "800087418",
                "codigo" => "2473",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "MORROW",
                "modelo" => "LOTUS ",
                "nro_serie" => "8226533154",
                "codigo" => "2474",
                "talle_id" => 14,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SANTA CRUZ",
                "modelo" => " TIGER ",
                "nro_serie" => "800089281",
                "codigo" => "2475",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SANTA CRUZ",
                "modelo" => " TIGER ",
                "nro_serie" => "800089256",
                "codigo" => "2476",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "SANTA CRUZ",
                "modelo" => " TIGER ",
                "nro_serie" => "800089277",
                "codigo" => "2477",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "LAMAR",
                "modelo" => "BELLE",
                "nro_serie" => "08201215100012",
                "codigo" => "2479",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "KEMPER",
                "modelo" => "DIVA",
                "nro_serie" => "...",
                "codigo" => "2478",
                "talle_id" => 13,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLEX 4D",
                "nro_serie" => "1376286",
                "codigo" => "2480",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLEX 4D",
                "nro_serie" => "14906270",
                "codigo" => "2481",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLEX 4D",
                "nro_serie" => "10205310",
                "codigo" => "2496",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLEX 4D",
                "nro_serie" => "10202980",
                "codigo" => "2482",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLEX 4D",
                "nro_serie" => "10205380",
                "codigo" => "2483",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLEX 4D",
                "nro_serie" => "10806060",
                "codigo" => "2484",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLEX 4D",
                "nro_serie" => "10806220",
                "codigo" => "2485",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLEX 4D",
                "nro_serie" => "12200640",
                "codigo" => "2486",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLEX 4D",
                "nro_serie" => "12200640",
                "codigo" => "2487",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLEX 4D",
                "nro_serie" => "05101520",
                "codigo" => "2488",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLEX 4D",
                "nro_serie" => "05101540",
                "codigo" => "2489",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLEX 4D",
                "nro_serie" => "05101530",
                "codigo" => "2490",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLEX 4D",
                "nro_serie" => "10806000",
                "codigo" => "2491",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLEX 4D",
                "nro_serie" => "11001010",
                "codigo" => "2492",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLEX 4D",
                "nro_serie" => "10305860",
                "codigo" => "2493",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLEX 4D",
                "nro_serie" => "14805530",
                "codigo" => "2494",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RC ONE 78 CELESTE",
                "nro_serie" => "23913250 ",
                "codigo" => "0927 ",
                "talle_id" => 10,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RC ONE 78 CELESTE",
                "nro_serie" => "23913217 ",
                "codigo" => "0928",
                "talle_id" => 10,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RC ONE 78 CELESTE",
                "nro_serie" => "24010791 ",
                "codigo" => "0929",
                "talle_id" => 10,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RC ONE 78 CELESTE",
                "nro_serie" => "23913253",
                "codigo" => "0930",
                "talle_id" => 10,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RC ONE 78 CELESTE",
                "nro_serie" => "23913252",
                "codigo" => "0931",
                "talle_id" => 10,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RC ONE 78 CELESTE",
                "nro_serie" => "23411158 ",
                "codigo" => "0932",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RC ONE 78 CELESTE",
                "nro_serie" => "23411159 ",
                "codigo" => "0933",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RC ONE 78 CELESTE",
                "nro_serie" => "23411157 ",
                "codigo" => "0934",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RC ONE 78 CELESTE",
                "nro_serie" => "23411162 ",
                "codigo" => "0935",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RC ONE 78 CELESTE",
                "nro_serie" => "23411161 ",
                "codigo" => "0936",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RC ONE 78 CELESTE",
                "nro_serie" => "23411156 ",
                "codigo" => "0937",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RC ONE 78 CELESTE",
                "nro_serie" => "24110613 ",
                "codigo" => "0938",
                "talle_id" => 17,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RC ONE 78 CELESTE",
                "nro_serie" => "24110600 ",
                "codigo" => "0939",
                "talle_id" => 17,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RC ONE 78 CELESTE",
                "nro_serie" => "24110606 ",
                "codigo" => "0940",
                "talle_id" => 17,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RC ONE 78 CELESTE",
                "nro_serie" => "24110612 ",
                "codigo" => "0941",
                "talle_id" => 17,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RC ONE 78 CELESTE",
                "nro_serie" => "24110599 ",
                "codigo" => "0942",
                "talle_id" => 17,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "THE CURV XTR ROJO ",
                "nro_serie" => "00621803",
                "codigo" => "0943",
                "talle_id" => 21,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "THE CURV XTR ROJO ",
                "nro_serie" => "00621638 ",
                "codigo" => "0944",
                "talle_id" => 21,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "THE CURV XTR ROJO ",
                "nro_serie" => "00621630 ",
                "codigo" => "0945",
                "talle_id" => 21,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "THE CURV XTR ROJO ",
                "nro_serie" => "00621628 ",
                "codigo" => "0946",
                "talle_id" => 21,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "THE CURV XTR ROJO ",
                "nro_serie" => "00621624 ",
                "codigo" => "0947",
                "talle_id" => 21,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RACE ONE 77 XTR",
                "nro_serie" => "04820360",
                "codigo" => "0976",
                "talle_id" => 10,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RACE ONE 77 XTR",
                "nro_serie" => "04820358",
                "codigo" => "0975",
                "talle_id" => 10,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RACE ONE 77 XTR",
                "nro_serie" => "04820364",
                "codigo" => "0974",
                "talle_id" => 10,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RACE ONE 77 XTR",
                "nro_serie" => "04820363",
                "codigo" => "0973",
                "talle_id" => 10,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RACE ONE 77 XTR",
                "nro_serie" => "04820356",
                "codigo" => "0972",
                "talle_id" => 10,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RACE ONE 77 XTR",
                "nro_serie" => "04820355",
                "codigo" => "0948",
                "talle_id" => 10,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RACE ONE 77 XTR",
                "nro_serie" => "04820359",
                "codigo" => "0949",
                "talle_id" => 10,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RACE ONE 77 XTR",
                "nro_serie" => "04820369",
                "codigo" => "0950",
                "talle_id" => 10,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RACE ONE 77 XTR",
                "nro_serie" => "04820362",
                "codigo" => "0951",
                "talle_id" => 10,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RACE ONE 77 XTR",
                "nro_serie" => "03612795",
                "codigo" => "0952",
                "talle_id" => 10,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RACE ONE 77 XTR",
                "nro_serie" => "04820380",
                "codigo" => "0953",
                "talle_id" => 10,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RACE ONE 77 XTR",
                "nro_serie" => "04820370",
                "codigo" => "0954",
                "talle_id" => 10,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RACE ONE 78 GT RT",
                "nro_serie" => "23110477",
                "codigo" => "0955",
                "talle_id" => 17,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RACE ONE 78 GT RT",
                "nro_serie" => "23110536",
                "codigo" => "0956",
                "talle_id" => 17,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RACE ONE 78 GT RT",
                "nro_serie" => "23110535",
                "codigo" => "0957",
                "talle_id" => 17,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RACE ONE 78 GT RT",
                "nro_serie" => "23110474",
                "codigo" => "0958",
                "talle_id" => 17,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RACE ONE 78 GT RT",
                "nro_serie" => "23011113",
                "codigo" => "0959",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RC4 THE CURV PRO",
                "nro_serie" => "05123250",
                "codigo" => "0960",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RC4 THE CURV PRO",
                "nro_serie" => "05123270",
                "codigo" => "0961",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RC4 THE CURV PRO",
                "nro_serie" => "05123249",
                "codigo" => "0962",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RC4 THE CURV PRO",
                "nro_serie" => "05123253",
                "codigo" => "0963",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RC4 THE CURV PRO",
                "nro_serie" => "05123251",
                "codigo" => "0964",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RC4 THE CURV PRO",
                "nro_serie" => "05123252",
                "codigo" => "0965",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RC4 THE CURV PRO",
                "nro_serie" => "05123269",
                "codigo" => "0966",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RC4 THE CURV PRO",
                "nro_serie" => "05123280",
                "codigo" => "0967",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RC4 THE CURV PRO",
                "nro_serie" => "05123279",
                "codigo" => "0968",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RC4 THE CURV PRO",
                "nro_serie" => "05123272",
                "codigo" => "0969",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RC4 THE CURV PRO",
                "nro_serie" => "05123282",
                "codigo" => "0970",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RC4 THE CURV PRO",
                "nro_serie" => "05123281",
                "codigo" => "0971",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLEX 4D",
                "nro_serie" => "149006830 ",
                "codigo" => "2495",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "CAPITA",
                "modelo" => "URGONNABOK",
                "nro_serie" => "04331307",
                "codigo" => "2497",
                "talle_id" => 10,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "CAPITA",
                "modelo" => "URGONNABOK",
                "nro_serie" => "04328396",
                "codigo" => "2498",
                "talle_id" => 10,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "CAPITA",
                "modelo" => "URGONNABOK",
                "nro_serie" => "04304750",
                "codigo" => "2499",
                "talle_id" => 10,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "CAPITA",
                "modelo" => "URGONNABOK",
                "nro_serie" => "04327374",
                "codigo" => "2500",
                "talle_id" => 10,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "CAPITA",
                "modelo" => "URGONNABOK",
                "nro_serie" => "04304752",
                "codigo" => "2501",
                "talle_id" => 10,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "CAPITA",
                "modelo" => "URGONNABOK",
                "nro_serie" => "04302350",
                "codigo" => "2502",
                "talle_id" => 10,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "CAPITA",
                "modelo" => "URGONNABOK",
                "nro_serie" => "04330291",
                "codigo" => "2503",
                "talle_id" => 10,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "CAPITA",
                "modelo" => "URGONNABOK",
                "nro_serie" => "04306140",
                "codigo" => "2504",
                "talle_id" => 10,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "CAPITA",
                "modelo" => "URGONNABOK",
                "nro_serie" => "04305288",
                "codigo" => "2505",
                "talle_id" => 10,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "CAPITA",
                "modelo" => "URGONNABOK",
                "nro_serie" => "04329695",
                "codigo" => "2506",
                "talle_id" => 10,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "CAPITA",
                "modelo" => "URGONNABOK",
                "nro_serie" => "04328392",
                "codigo" => "2507",
                "talle_id" => 10,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "CAPITA",
                "modelo" => "URGONNABOK",
                "nro_serie" => "04330283",
                "codigo" => "2508",
                "talle_id" => 10,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "CAPITA",
                "modelo" => "URGONNABOK",
                "nro_serie" => "04305312",
                "codigo" => "2509",
                "talle_id" => 10,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "CAPITA",
                "modelo" => "URGONNABOK",
                "nro_serie" => "04306249",
                "codigo" => "2510",
                "talle_id" => 10,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "CAPITA",
                "modelo" => "URGONNABOK ",
                "nro_serie" => "04328387",
                "codigo" => "2511",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "CAPITA",
                "modelo" => "URGONNABOK ",
                "nro_serie" => "04326654",
                "codigo" => "2512",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "CAPITA",
                "modelo" => "URGONNABOK ",
                "nro_serie" => "04330224",
                "codigo" => "2513",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "CAPITA",
                "modelo" => "URGONNABOK ",
                "nro_serie" => "04272631",
                "codigo" => "2514",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "CAPITA",
                "modelo" => "URGONNABOK ",
                "nro_serie" => "04302466",
                "codigo" => "2515",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "CAPITA",
                "modelo" => "URGONNABOK",
                "nro_serie" => "04330310",
                "codigo" => "2516",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "CAPITA",
                "modelo" => "URGONNABOK",
                "nro_serie" => "04306268",
                "codigo" => "2517",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "CAPITA",
                "modelo" => "URGONNABOK WIDE",
                "nro_serie" => "04330395",
                "codigo" => "2518",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "CAPITA",
                "modelo" => "URGONNABOK WIDE",
                "nro_serie" => "04327375",
                "codigo" => "2519",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "CAPITA",
                "modelo" => "URGONNABOK WIDE",
                "nro_serie" => "04330398",
                "codigo" => "2520",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "CAPITA",
                "modelo" => "URGONNABOK WIDE",
                "nro_serie" => "04304255",
                "codigo" => "2521",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "CAPITA",
                "modelo" => "OUTERSPACE LIVING FSC",
                "nro_serie" => "04327047",
                "codigo" => "2522",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "CAPITA",
                "modelo" => "OUTERSPACE LIVING FSC",
                "nro_serie" => "04327520",
                "codigo" => "2523",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "CAPITA",
                "modelo" => "OUTERSPACE LIVING FSC",
                "nro_serie" => "04330396",
                "codigo" => "2524",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "CAPITA",
                "modelo" => "OUTERSPACE LIVING FSC",
                "nro_serie" => "04306271",
                "codigo" => "2525",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "CAPITA",
                "modelo" => "OUTERSPACE LIVING FSC",
                "nro_serie" => "04331281",
                "codigo" => "2526",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "CAPITA",
                "modelo" => "OUTERSPACE LIVING FSC",
                "nro_serie" => "04272868",
                "codigo" => "2527",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "NORDICA",
                "modelo" => "FREESTYLE MARKER ",
                "nro_serie" => "1164381",
                "codigo" => "0555",
                "talle_id" => 23,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RACE ONE 78 GT RT",
                "nro_serie" => "25113313",
                "codigo" => "0979",
                "talle_id" => 26,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RACE ONE 78 GT RT",
                "nro_serie" => "25211695",
                "codigo" => "0980",
                "talle_id" => 26,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RACE ONE 78 GT RT",
                "nro_serie" => "25113326",
                "codigo" => "0981",
                "talle_id" => 26,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RC ONE 82 GT RT AZUL",
                "nro_serie" => "24914074",
                "codigo" => "0982",
                "talle_id" => 17,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RC ONE 82 GT RT AZUL",
                "nro_serie" => "30893289",
                "codigo" => "0983",
                "talle_id" => 17,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RC ONE 82 GT RT AZUL",
                "nro_serie" => "30893291",
                "codigo" => "0984",
                "talle_id" => 17,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RC4 THE CURV PRO",
                "nro_serie" => "05123287",
                "codigo" => "0985",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR 77",
                "nro_serie" => "04011210",
                "codigo" => "0986",
                "talle_id" => 10,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR 77",
                "nro_serie" => "04011212",
                "codigo" => "0987",
                "talle_id" => 10,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "THE CURV PRO RC4 NEGRO Y AZUL ",
                "nro_serie" => "03711809",
                "codigo" => "0988",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RC ONE 78 CELESTE",
                "nro_serie" => "23411149",
                "codigo" => "0992",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RC ONE 78 CELESTE",
                "nro_serie" => "23411152",
                "codigo" => "0990",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RC ONE 78 CELESTE",
                "nro_serie" => "23411150",
                "codigo" => "0991",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RC ONE 78 CELESTE",
                "nro_serie" => "23011049",
                "codigo" => "0989",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RC ONE 78 CELESTE",
                "nro_serie" => "23411151",
                "codigo" => "0993",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RC ONE 78 CELESTE",
                "nro_serie" => "23011046",
                "codigo" => "0994",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RC ONE 78 CELESTE",
                "nro_serie" => "23913242",
                "codigo" => "0995",
                "talle_id" => 10,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RC ONE 78 CELESTE",
                "nro_serie" => "23913218",
                "codigo" => "0996",
                "talle_id" => 10,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RC ONE 78 CELESTE",
                "nro_serie" => "23913243",
                "codigo" => "0997",
                "talle_id" => 10,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RC ONE 78 CELESTE",
                "nro_serie" => "23913241",
                "codigo" => "0998",
                "talle_id" => 10,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RC ONE 78 CELESTE",
                "nro_serie" => "24010804",
                "codigo" => "0999",
                "talle_id" => 10,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RC ONE 78 CELESTE",
                "nro_serie" => "24010805",
                "codigo" => "1000",
                "talle_id" => 10,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RC ONE 78 CELESTE",
                "nro_serie" => "23993257",
                "codigo" => "1001",
                "talle_id" => 10,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RC ONE 78 CELESTE",
                "nro_serie" => "23913254",
                "codigo" => "1002",
                "talle_id" => 10,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RC ONE 78 CELESTE",
                "nro_serie" => "23913262",
                "codigo" => "1003",
                "talle_id" => 10,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RC ONE 78 CELESTE",
                "nro_serie" => "23913261",
                "codigo" => "1004",
                "talle_id" => 10,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RC ONE 78 CELESTE",
                "nro_serie" => "23913251",
                "codigo" => "1005",
                "talle_id" => 10,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RC ONE 78 CELESTE",
                "nro_serie" => "24010801",
                "codigo" => "1006",
                "talle_id" => 10,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RC ONE 78 CELESTE",
                "nro_serie" => "24010806",
                "codigo" => "1007",
                "talle_id" => 10,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RC ONE 78 CELESTE",
                "nro_serie" => "23913244",
                "codigo" => "1008",
                "talle_id" => 10,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR RC ONE 78 CELESTE",
                "nro_serie" => "24010803",
                "codigo" => "1009",
                "talle_id" => 10,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "ROJO",
                "nro_serie" => "108023 ",
                "codigo" => "1010",
                "talle_id" => 55,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLOCKA LFW 2.0 4D ",
                "nro_serie" => "1852027",
                "codigo" => "2528",
                "talle_id" => 9,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLOCKA LFW 2.0 4D ",
                "nro_serie" => "2094167",
                "codigo" => "2529",
                "talle_id" => 10,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLEX 4D",
                "nro_serie" => "1393986",
                "codigo" => "2530",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLOCKA LFW 2.0 4D ",
                "nro_serie" => "1855727",
                "codigo" => "2531",
                "talle_id" => 13,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLOCKA LFW 2.0 4D ",
                "nro_serie" => "2094595",
                "codigo" => "2532",
                "talle_id" => 9,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLOCKA LFW 2.0 4D ",
                "nro_serie" => "2094084",
                "codigo" => "2533",
                "talle_id" => 10,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLOCKA LFW 2.0 4D ",
                "nro_serie" => "2094116",
                "codigo" => "2534",
                "talle_id" => 10,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLOCKA LFW 2.0 4D ",
                "nro_serie" => "2056488",
                "codigo" => "2535",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLEX 4D",
                "nro_serie" => "1866571",
                "codigo" => "2536",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLOCKA LFW 2.0 4D ",
                "nro_serie" => "2056583",
                "codigo" => "2537",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLOCKA LFW 2.0 4D ",
                "nro_serie" => "2056484",
                "codigo" => "2538",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLEX 4D",
                "nro_serie" => "2056459",
                "codigo" => "2539",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLOCKA LFW 2.0 4D ",
                "nro_serie" => "1868087",
                "codigo" => "2540",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLOCKA LFW 2.0 4D ",
                "nro_serie" => "1868233",
                "codigo" => "2541",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLOCKA LFW 2.0 4D ",
                "nro_serie" => "1867781",
                "codigo" => "2542",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLOCKA LFW 2.0 4D ",
                "nro_serie" => "1868162",
                "codigo" => "2543",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLOCKA LFW 2.0 4D ",
                "nro_serie" => "1867341",
                "codigo" => "2544",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLOCKA LFW 2.0 4D ",
                "nro_serie" => "1868093",
                "codigo" => "2545",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLOCKA LFW 2.0 4D ",
                "nro_serie" => "1868199",
                "codigo" => "2546",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLOCKA LFW 2.0 4D ",
                "nro_serie" => "1868068",
                "codigo" => "2547",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLOCKA LFW 2.0 4D ",
                "nro_serie" => "1867808",
                "codigo" => "2548",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLOCKA LFW 2.0 WIDE",
                "nro_serie" => "1851539",
                "codigo" => "2549",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLOCKA LFW 2.0 WIDE",
                "nro_serie" => "1851525",
                "codigo" => "2550",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLOCKA LFW 2.0 WIDE",
                "nro_serie" => "1851526",
                "codigo" => "2551",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLOCKA LFW 2.0 WIDE",
                "nro_serie" => "1852699",
                "codigo" => "2552",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLOCKA LFW 2.0 WIDE",
                "nro_serie" => "2055655",
                "codigo" => "2553",
                "talle_id" => 21,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLOCKA LFW 2.0 WIDE",
                "nro_serie" => "2055436",
                "codigo" => "2554",
                "talle_id" => 21,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLOCKA LFW 2.0 WIDE",
                "nro_serie" => "2055423",
                "codigo" => "2555",
                "talle_id" => 21,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLOCKA LFW 2.0 WIDE",
                "nro_serie" => "2055605",
                "codigo" => "2556",
                "talle_id" => 21,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLOCKA LFW 2.0 4D ",
                "nro_serie" => "1851427",
                "codigo" => "2557",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLEX 4D",
                "nro_serie" => "1856216",
                "codigo" => "2558",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "TECHNINE",
                "modelo" => "TT AUTOS ",
                "nro_serie" => "20151806",
                "codigo" => "2559",
                "talle_id" => 14,
                "tipo_articulo_id" => 4
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2126661",
                "codigo" => "1011",
                "talle_id" => 56,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2126664",
                "codigo" => "1012",
                "talle_id" => 56,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2116601",
                "codigo" => "1013",
                "talle_id" => 56,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLOCKA LFW 2.0 4D ",
                "nro_serie" => "1852419",
                "codigo" => "2560",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLOCKA LFW 2.0 WIDE",
                "nro_serie" => "2055627",
                "codigo" => "2561",
                "talle_id" => 21,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2116587",
                "codigo" => "1014",
                "talle_id" => 56,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2126655",
                "codigo" => "1015",
                "talle_id" => 56,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2319292",
                "codigo" => "1016",
                "talle_id" => 57,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2319300",
                "codigo" => "1017",
                "talle_id" => 57,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2319296",
                "codigo" => "1018",
                "talle_id" => 57,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2319297",
                "codigo" => "1019",
                "talle_id" => 57,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2319293",
                "codigo" => "1020",
                "talle_id" => 57,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2210033",
                "codigo" => "1021",
                "talle_id" => 1,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2211066",
                "codigo" => "1022",
                "talle_id" => 1,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2211075",
                "codigo" => "1023",
                "talle_id" => 1,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2210029",
                "codigo" => "1024",
                "talle_id" => 1,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2211062",
                "codigo" => "1025",
                "talle_id" => 1,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2320497",
                "codigo" => "1026",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2319469",
                "codigo" => "1027",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2320414",
                "codigo" => "1028",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY EASY",
                "nro_serie" => "0850825",
                "codigo" => "1029",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY EASY",
                "nro_serie" => "0850778",
                "codigo" => "1030",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY EASY",
                "nro_serie" => "0850777",
                "codigo" => "1031",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY EASY",
                "nro_serie" => "0850811",
                "codigo" => "1032",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY EASY",
                "nro_serie" => "0850749",
                "codigo" => "1033",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY EASY",
                "nro_serie" => "0850783",
                "codigo" => "1034",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY EASY",
                "nro_serie" => "0715859",
                "codigo" => "1035",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY EASY",
                "nro_serie" => "0727437",
                "codigo" => "1036",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY EASY",
                "nro_serie" => "0715833",
                "codigo" => "1037",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY EASY",
                "nro_serie" => "0727420",
                "codigo" => "1038",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY EASY",
                "nro_serie" => "0727424",
                "codigo" => "1039",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY EASY",
                "nro_serie" => "0715867",
                "codigo" => "1040",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY EASY",
                "nro_serie" => "0715795",
                "codigo" => "1048",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY EASY",
                "nro_serie" => "0715857",
                "codigo" => "1041",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY EASY",
                "nro_serie" => "0715863",
                "codigo" => "1042",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY EASY",
                "nro_serie" => "0715864",
                "codigo" => "1043",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY EASY",
                "nro_serie" => "0715873",
                "codigo" => "1044",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY EASY",
                "nro_serie" => "0715819",
                "codigo" => "1045",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY EASY",
                "nro_serie" => "0715870",
                "codigo" => "1046",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY EASY",
                "nro_serie" => "0715828",
                "codigo" => "1047",
                "talle_id" => 5,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY EASY",
                "nro_serie" => "1026905",
                "codigo" => "1049",
                "talle_id" => 1,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY EASY",
                "nro_serie" => "1026899",
                "codigo" => "1050",
                "talle_id" => 1,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY EASY",
                "nro_serie" => "1026925",
                "codigo" => "1051",
                "talle_id" => 1,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY EASY",
                "nro_serie" => "1026934",
                "codigo" => "1052",
                "talle_id" => 1,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY EASY",
                "nro_serie" => "1026924",
                "codigo" => "1053",
                "talle_id" => 1,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY EASY",
                "nro_serie" => "1026935",
                "codigo" => "1054",
                "talle_id" => 1,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2319410",
                "codigo" => "1055",
                "talle_id" => 1,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2319408",
                "codigo" => "1056",
                "talle_id" => 1,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2319425",
                "codigo" => "1057",
                "talle_id" => 1,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2211063",
                "codigo" => "1058",
                "talle_id" => 1,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY EASY",
                "nro_serie" => "0850793",
                "codigo" => "1059",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY EASY",
                "nro_serie" => "0850799",
                "codigo" => "1060",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY EASY",
                "nro_serie" => "0850745",
                "codigo" => "1061",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY EASY",
                "nro_serie" => "0850804",
                "codigo" => "1062",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2208505",
                "codigo" => "1063",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2208602",
                "codigo" => "1064",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2208619",
                "codigo" => "1065",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2208624",
                "codigo" => "1066",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY EASY",
                "nro_serie" => "0980159",
                "codigo" => "1067",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY EASY",
                "nro_serie" => "0980203",
                "codigo" => "1068",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY EASY",
                "nro_serie" => "0980224",
                "codigo" => "1069",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY EASY",
                "nro_serie" => "0980204",
                "codigo" => "1070",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY EASY",
                "nro_serie" => "0877473",
                "codigo" => "1071",
                "talle_id" => 7,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY EASY",
                "nro_serie" => "0877461",
                "codigo" => "1072",
                "talle_id" => 7,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY EASY",
                "nro_serie" => "0877475",
                "codigo" => "1073",
                "talle_id" => 7,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY EASY",
                "nro_serie" => "0856294",
                "codigo" => "1074",
                "talle_id" => 7,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY EASY",
                "nro_serie" => "0856274",
                "codigo" => "1075",
                "talle_id" => 7,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY EASY",
                "nro_serie" => "0856278",
                "codigo" => "1076",
                "talle_id" => 7,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY EASY",
                "nro_serie" => "0856292",
                "codigo" => "1077",
                "talle_id" => 7,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE CX GRIS",
                "nro_serie" => "2340616",
                "codigo" => "1078",
                "talle_id" => 14,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE CX GRIS",
                "nro_serie" => "2340615",
                "codigo" => "1079",
                "talle_id" => 14,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE CX GRIS",
                "nro_serie" => "2335609",
                "codigo" => "1080",
                "talle_id" => 14,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE CX GRIS",
                "nro_serie" => "2340612",
                "codigo" => "1081",
                "talle_id" => 14,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE CX GRIS",
                "nro_serie" => "2340617",
                "codigo" => "1082",
                "talle_id" => 14,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE CX GRIS",
                "nro_serie" => "2335611",
                "codigo" => "1083",
                "talle_id" => 14,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE CX GRIS",
                "nro_serie" => "2335604",
                "codigo" => "1084",
                "talle_id" => 14,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE CX GRIS",
                "nro_serie" => "2335602",
                "codigo" => "1085",
                "talle_id" => 14,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE CX GRIS ",
                "nro_serie" => "2109871",
                "codigo" => "1086",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE CX GRIS ",
                "nro_serie" => "2109868",
                "codigo" => "1087",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE CX GRIS ",
                "nro_serie" => "2109865",
                "codigo" => "1088",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE CX GRIS",
                "nro_serie" => "2340620",
                "codigo" => "1089",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE CX GRIS",
                "nro_serie" => "2340613",
                "codigo" => "1090",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE CX GRIS",
                "nro_serie" => "2340624",
                "codigo" => "1091",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE CX GRIS",
                "nro_serie" => "2340619",
                "codigo" => "1092",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE CX GRIS",
                "nro_serie" => "2340621",
                "codigo" => "1093",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE CX GRIS",
                "nro_serie" => "2335608",
                "codigo" => "1094",
                "talle_id" => 14,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE CX GRIS",
                "nro_serie" => "2329784",
                "codigo" => "1098",
                "talle_id" => 18,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE CX GRIS",
                "nro_serie" => "2329793",
                "codigo" => "1097",
                "talle_id" => 18,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE CX GRIS",
                "nro_serie" => "2329781",
                "codigo" => "1096",
                "talle_id" => 18,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE CX GRIS",
                "nro_serie" => "2329790",
                "codigo" => "1095",
                "talle_id" => 18,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE CX GRIS",
                "nro_serie" => "2335385",
                "codigo" => "1099",
                "talle_id" => 18,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE CX GRIS",
                "nro_serie" => "2335385",
                "codigo" => "1099",
                "talle_id" => 18,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE CX GRIS",
                "nro_serie" => "2335388",
                "codigo" => "1100",
                "talle_id" => 18,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE CX GRIS",
                "nro_serie" => "2335378",
                "codigo" => "1101",
                "talle_id" => 18,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE CX GRIS",
                "nro_serie" => "2335389",
                "codigo" => "1102",
                "talle_id" => 18,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V5",
                "nro_serie" => "2122721",
                "codigo" => "1108",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V5",
                "nro_serie" => "2122723",
                "codigo" => "1109",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V5",
                "nro_serie" => "2321343",
                "codigo" => "1110",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V5",
                "nro_serie" => "2122720",
                "codigo" => "1111",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V5",
                "nro_serie" => "2341625",
                "codigo" => "1112",
                "talle_id" => 18,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "V - SHAPE  VR",
                "nro_serie" => "1080572",
                "codigo" => "1104",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "V - SHAPE  VR",
                "nro_serie" => "0010096",
                "codigo" => "1105",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V5",
                "nro_serie" => "1080539",
                "codigo" => "1106",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V5",
                "nro_serie" => "0936382",
                "codigo" => "1107",
                "talle_id" => 18,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "V - SHAPE  VR",
                "nro_serie" => "1088785",
                "codigo" => "1103",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V5",
                "nro_serie" => "2341601",
                "codigo" => "1113",
                "talle_id" => 18,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V5",
                "nro_serie" => "2341619",
                "codigo" => "1114",
                "talle_id" => 18,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY",
                "nro_serie" => "0949054",
                "codigo" => "1115",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY",
                "nro_serie" => "0949414",
                "codigo" => "1116",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY EASY",
                "nro_serie" => "0877502",
                "codigo" => "1120",
                "talle_id" => 7,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY EASY",
                "nro_serie" => "0877486",
                "codigo" => "1119",
                "talle_id" => 7,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY EASY",
                "nro_serie" => "0877479",
                "codigo" => "1118",
                "talle_id" => 7,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY EASY",
                "nro_serie" => "0877469",
                "codigo" => "1117",
                "talle_id" => 7,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "V - SHAPE  VR",
                "nro_serie" => "0936321",
                "codigo" => "1122",
                "talle_id" => 18,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "V - SHAPE  VR",
                "nro_serie" => "0936338",
                "codigo" => "1121",
                "talle_id" => 18,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "V - SHAPE  VR",
                "nro_serie" => "0936360",
                "codigo" => "1123",
                "talle_id" => 18,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "V - SHAPE  VR",
                "nro_serie" => "0936364",
                "codigo" => "1124",
                "talle_id" => 18,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V5",
                "nro_serie" => "2125978",
                "codigo" => "1125",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V5",
                "nro_serie" => "2125977",
                "codigo" => "1126",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "V - SHAPE  VR",
                "nro_serie" => "1080529",
                "codigo" => "1127",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPER SHAPE TEAM ",
                "nro_serie" => "2202965",
                "codigo" => "1128",
                "talle_id" => 8,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPER SHAPE TEAM ",
                "nro_serie" => "2203507",
                "codigo" => "1129",
                "talle_id" => 8,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPER SHAPE TEAM ",
                "nro_serie" => "2203510",
                "codigo" => "1131",
                "talle_id" => 8,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPER SHAPE TEAM ",
                "nro_serie" => "2203508",
                "codigo" => "1132",
                "talle_id" => 8,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2203509",
                "codigo" => "1133",
                "talle_id" => 56,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "V - SHAPE  VR",
                "nro_serie" => "0908061",
                "codigo" => "1138",
                "talle_id" => 14,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "V - SHAPE  VR",
                "nro_serie" => "0907981",
                "codigo" => "1139",
                "talle_id" => 14,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "V - SHAPE  VR",
                "nro_serie" => "0908040",
                "codigo" => "1140",
                "talle_id" => 14,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "V - SHAPE  VR",
                "nro_serie" => "0908051",
                "codigo" => "1141",
                "talle_id" => 14,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "V - SHAPE  VR",
                "nro_serie" => "0907962",
                "codigo" => "1142",
                "talle_id" => 14,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "V - SHAPE  VR",
                "nro_serie" => "1086779",
                "codigo" => "1143",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "V - SHAPE  VR",
                "nro_serie" => "1086756",
                "codigo" => "1144",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "V - SHAPE  VR",
                "nro_serie" => "1086847",
                "codigo" => "1145",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "V - SHAPE  VR",
                "nro_serie" => "1086767",
                "codigo" => "1146",
                "talle_id" => 9,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY",
                "nro_serie" => "0980222",
                "codigo" => "1148",
                "talle_id" => 8,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "JOY",
                "nro_serie" => "0980149",
                "codigo" => "1147",
                "talle_id" => 8,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLOCKA LFW 2.0 4D ",
                "nro_serie" => "1867345",
                "codigo" => "2562",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLOCKA LFW 2.0 4D ",
                "nro_serie" => "1868183",
                "codigo" => "2563",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLOCKA LFW 2.0 WIDE",
                "nro_serie" => "2055421",
                "codigo" => "2565",
                "talle_id" => 21,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLOCKA LFW 2.0 WIDE",
                "nro_serie" => "2055717",
                "codigo" => "2567",
                "talle_id" => 21,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLOCKA LFW 2.0 4D ",
                "nro_serie" => "1867724",
                "codigo" => "2573",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLOCKA LFW 2.0 WIDE",
                "nro_serie" => "2055919",
                "codigo" => "2571",
                "talle_id" => 18,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLOCKA LFW 2.0 WIDE",
                "nro_serie" => "2055860",
                "codigo" => "2570",
                "talle_id" => 18,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLOCKA LFW 2.0 4D ",
                "nro_serie" => "1851451",
                "codigo" => "2569",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLOCKA LFW 2.0 4D ",
                "nro_serie" => "1851447",
                "codigo" => "2568",
                "talle_id" => 17,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLOCKA LFW 2.0 4D ",
                "nro_serie" => "1867762",
                "codigo" => "2574",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLOCKA LFW 2.0 WIDE",
                "nro_serie" => "2055945",
                "codigo" => "2572",
                "talle_id" => 18,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLOCKA LFW 2.0 4D ",
                "nro_serie" => "1867735",
                "codigo" => "2575",
                "talle_id" => 14,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLOCKA LFW 2.0 WIDE",
                "nro_serie" => "2055926",
                "codigo" => "2576",
                "talle_id" => 18,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLOCKA LFW 2.0 WIDE",
                "nro_serie" => "2055943",
                "codigo" => "2577",
                "talle_id" => 18,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V2",
                "nro_serie" => "2117337",
                "codigo" => "0845",
                "talle_id" => 14,
                "tipo_articulo_id" => 3
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RACE",
                "nro_serie" => "11212472",
                "codigo" => "735",
                "talle_id" => 1,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "RC4 RACE",
                "nro_serie" => "34413914",
                "codigo" => "694",
                "talle_id" => 3,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "FLOCKA LFW 2.0 WIDE",
                "nro_serie" => "2055662",
                "codigo" => "2566",
                "talle_id" => 21,
                "tipo_articulo_id" => 5
            ],
            [
                "marca" => "FISCHER",
                "modelo" => "XTR KOA",
                "nro_serie" => "111",
                "codigo" => "0661",
                "talle_id" => 14,
                "tipo_articulo_id" => 2
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2717058",
                "codigo" => "1152",
                "talle_id" => 57,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2717057",
                "codigo" => "1151",
                "talle_id" => 57,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2717055",
                "codigo" => "1150",
                "talle_id" => 57,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2717046",
                "codigo" => "1149",
                "talle_id" => 57,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2717048",
                "codigo" => "1166",
                "talle_id" => 57,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2717512",
                "codigo" => "1153",
                "talle_id" => 6,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2717515",
                "codigo" => "1154",
                "talle_id" => 6,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2717514",
                "codigo" => "1155",
                "talle_id" => 6,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2717509",
                "codigo" => "1156",
                "talle_id" => 6,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2717510",
                "codigo" => "1157",
                "talle_id" => 6,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY JR",
                "nro_serie" => "2738733",
                "codigo" => "1158",
                "talle_id" => 4,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY JR",
                "nro_serie" => "2738734",
                "codigo" => "1159",
                "talle_id" => 4,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2717517",
                "codigo" => "1160",
                "talle_id" => 6,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2717516",
                "codigo" => "1161",
                "talle_id" => 6,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY",
                "nro_serie" => "2717508",
                "codigo" => "1162",
                "talle_id" => 6,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY JR",
                "nro_serie" => "2722121",
                "codigo" => "1163",
                "talle_id" => 4,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY JR",
                "nro_serie" => "2722132",
                "codigo" => "1164",
                "talle_id" => 4,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SUPERSHAPE EASY JR",
                "nro_serie" => "2722129",
                "codigo" => "1165",
                "talle_id" => 4,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V5",
                "nro_serie" => "2341625",
                "codigo" => "1167",
                "talle_id" => 18,
                "tipo_articulo_id" => 1
            ],
            [
                "marca" => "HEAD",
                "modelo" => "SHAPE V5",
                "nro_serie" => "2125990",
                "codigo" => "1168",
                "talle_id" => 13,
                "tipo_articulo_id" => 1
            ]
        ];

        foreach ($articulos as $articulo) {
            $marca = Marca::where('descripcion', Str::trim($articulo["marca"]))->first();
            $modelo = Modelo::where('descripcion', Str::trim($articulo["modelo"]))->first();

            if ($marca == null || $modelo == null) {
                dd($articulo);
            }

            Articulo::create([
                "descripcion" => "",
                "tipo_articulo_id" => $articulo["tipo_articulo_id"],
                "talle_id" => $articulo["talle_id"],
                "marca_id" => $marca->id,
                "modelo_id" => $modelo->id,
                "codigo" => $articulo["codigo"],
                "nro_serie" => $articulo["nro_serie"],
            ]);
        }


        // enable fk check
    }
}
