<?php

namespace Database\Seeders;

use App\Models\Articulo;
use App\Models\Marca;
use App\Models\Modelo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class Modelos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // // db truncate
        // disable fk check
        Modelo::truncate();

        $modelos = [
            [
                "marca" => "BLIZZARD",
                "descripcion" => "ALIGHT 7.7"
            ],
            [
                "marca" => "BLIZZARD",
                "descripcion" => "ELEVATE RTX"
            ],
            [
                "marca" => "BLIZZARD",
                "descripcion" => "FIREBIRD"
            ],
            [
                "marca" => "BLIZZARD",
                "descripcion" => "FIREBIRD JR"
            ],
            [
                "marca" => "BLIZZARD",
                "descripcion" => "IQ RC"
            ],
            [
                "marca" => "BLIZZARD",
                "descripcion" => "MAGNIUM JR"
            ],
            [
                "marca" => "BLIZZARD",
                "descripcion" => "POWER IQ JR"
            ],
            [
                "marca" => "BLIZZARD",
                "descripcion" => "QUATTRO 7.2 BLANCA"
            ],
            [
                "marca" => "BLIZZARD",
                "descripcion" => "QUATTRO 7.2 PINK"
            ],
            [
                "marca" => "BLIZZARD",
                "descripcion" => "QUATTRO 7.4"
            ],
            [
                "marca" => "BLIZZARD",
                "descripcion" => "QUATTRO 8.0"
            ],
            [
                "marca" => "BLIZZARD",
                "descripcion" => "QUATTRO7.7"
            ],
            [
                "marca" => "BLIZZARD",
                "descripcion" => "RACE TI"
            ],
            [
                "marca" => "BLIZZARD",
                "descripcion" => "RTX"
            ],
            [
                "marca" => "BLIZZARD",
                "descripcion" => "RTX JR"
            ],
            [
                "marca" => "BLIZZARD",
                "descripcion" => "RTX RACE"
            ],
            [
                "marca" => "BLIZZARD",
                "descripcion" => "VIVA JR"
            ],
            [
                "marca" => "BLIZZARD",
                "descripcion" => "WCR-A"
            ],
            [
                "marca" => "BLIZZARD",
                "descripcion" => "WCR-AN"
            ],
            [
                "marca" => "BLIZZARD",
                "descripcion" => "WCR-B"
            ],
            [
                "marca" => "BLIZZARD",
                "descripcion" => "WCR-N"
            ],
            [
                "marca" => "BLIZZARD",
                "descripcion" => "XCR AMARILLO"
            ],
            [
                "marca" => "BLIZZARD",
                "descripcion" => "XCR ROJO"
            ],
            [
                "marca" => "BURTON",
                "descripcion" => "AMARILLA Y NEGRO"
            ],
            [
                "marca" => "BURTON",
                "descripcion" => "AZUL Y NARANJA"
            ],
            [
                "marca" => "BURTON",
                "descripcion" => "AZUL Y VERDE"
            ],
            [
                "marca" => "BURTON",
                "descripcion" => "CHICKLET JR"
            ],
            [
                "marca" => "BURTON",
                "descripcion" => "NARANJA Y NEGRO"
            ],
            [
                "marca" => "BURTON",
                "descripcion" => "NEGRA Y ROJA"
            ],
            [
                "marca" => "BURTON",
                "descripcion" => "VERDE"
            ],
            [
                "marca" => "BURTON",
                "descripcion" => "VERDE Y NEGRO"
            ],
            [
                "marca" => "BURTON",
                "descripcion" => "VERDE Y VIOLETA"
            ],
            [
                "marca" => "CAPITA",
                "descripcion" => "OUTERSPACE LIVING FSC"
            ],
            [
                "marca" => "CAPITA",
                "descripcion" => "URGONNABOK"
            ],
            [
                "marca" => "CAPITA",
                "descripcion" => "URGONNABOK WIDE"
            ],
            [
                "marca" => "DC",
                "descripcion" => "PLY"
            ],
            [
                "marca" => "ESCAPE",
                "descripcion" => "MILLENIUM THREE"
            ],
            [
                "marca" => "FIFTY ONE",
                "descripcion" => "SHOOTER"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "ADDICT TEAM "
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "BRILLIANT MTN "
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "BULLETPROOF XTR "
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "C-LINE EMPEROR"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "C-LINE TRIBUNE"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "CRUZAR"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "CRUZAR SPEED XTR"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "CURV JR"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "CURV XTR"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "CURV XTR"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "EUROPA PARK"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "KOA 75"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "KOA 80"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "KOA 84"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "KOA JR"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "KOA JR2"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "MOTIVA"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "MOTIVE 80 XTR BLANCO"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "MOTIVE 80 XTR NEGRO"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "MOTIVE JR"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "MOTIVE NARANJA "
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "MOTIVE76 XTR"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "MY MTN 80"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "MY MTN 80"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "MY XTR 77"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "PRODIGY"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "PRODIGY  -  VIOLETA NEGRO & AMARILLO"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "PRODIGY - BLANCO AZUL & NARANJA "
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "PRODIGY NARANJA"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "PROGRESSOR 900"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "PROGRESSOR F16"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "PROGRESSOR JR"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "PROGRESSOR WOODCORE"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "PROGRESSOR XTR RED"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "PROGRESSOR XTRS"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "RACE"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "RACE ONE 77 XTR"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "RACE ONE JR"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "RACE ONE JR PINK"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "RACE4 JR"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "RANGER  FREERIDE 84- VERDE Y  NEGRO "
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "RANGER 98 FREERIDE - VERDE Y  NEGRO "
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "RANGER FREERIDE 84  - VERDE Y  NEGRO "
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "RANGER FREERIDE 98 - VERDE Y  NEGRO "
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "RANGER JR FREERIDE - VERDE Y  NEGRO "
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "RC ONE 82 GT RT AZUL"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "RC ONE JR"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "RC4 JR"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "RC4 RACE"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "RC4 THE CURV PRO"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "STUNNER APPLE GREEN & LIGHT BLUE"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "STUNNER BLACK & YELLOW "
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "STUNNER JR"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "SUPERIOR "
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "SUPERIOR RC4"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "THE CURV PRO RC4 NEGRO Y AZUL "
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "THE CURV XTR"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "THE CURV XTR ROJO "
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "VIRON 2.2"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "WATEA"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "WORLDCUP BLANCA"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "XTR 73"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "XTR 77"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "XTR KOA"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "XTR MOTIVE BLANCO-MARRON"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "XTR PRO MT 80"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "XTR PRO MT X"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "XTR RACE"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "XTR RACE JR"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "XTR RACE ONE 78 GT RT"
            ],
            [
                "marca" => "FISCHER",
                "descripcion" => "XTR RC ONE 78 CELESTE"
            ],
            [
                "marca" => "FORUM",
                "descripcion" => "CHILLY DOG"
            ],
            [
                "marca" => "FORUM",
                "descripcion" => "MANUAL"
            ],
            [
                "marca" => "FORUM",
                "descripcion" => "THE MANUAL CHILLI DOG"
            ],
            [
                "marca" => "GNU",
                "descripcion" => "CARBON CREDITS SERIES"
            ],
            [
                "marca" => "HEAD",
                "descripcion" => "CONCEPT KID JR"
            ],
            [
                "marca" => "HEAD",
                "descripcion" => "CONCEPT KID JR GRIS"
            ],
            [
                "marca" => "HEAD",
                "descripcion" => "FLEX 4D"
            ],
            [
                "marca" => "HEAD",
                "descripcion" => "FLOCKA LFW 2.0 4D "
            ],
            [
                "marca" => "HEAD",
                "descripcion" => "FLOCKA LFW 2.0 WIDE"
            ],
            [
                "marca" => "HEAD",
                "descripcion" => "JOY"
            ],
            [
                "marca" => "HEAD",
                "descripcion" => "JOY"
            ],
            [
                "marca" => "HEAD",
                "descripcion" => "JOY EASY"
            ],
            [
                "marca" => "HEAD",
                "descripcion" => "JR NEMI"
            ],
            [
                "marca" => "HEAD",
                "descripcion" => "KORE X85"
            ],
            [
                "marca" => "HEAD",
                "descripcion" => "ROJO"
            ],
            [
                "marca" => "HEAD",
                "descripcion" => "SHAPE CX GRIS"
            ],
            [
                "marca" => "HEAD",
                "descripcion" => "SHAPE V2"
            ],
            [
                "marca" => "HEAD",
                "descripcion" => "SHAPE V5"
            ],
            [
                "marca" => "HEAD",
                "descripcion" => "SHAPE V5"
            ],
            [
                "marca" => "HEAD",
                "descripcion" => "SUPER SHAPE TEAM "
            ],
            [
                "marca" => "HEAD",
                "descripcion" => "SUPERSHAPE E-TITAN "
            ],
            [
                "marca" => "HEAD",
                "descripcion" => "SUPERSHAPE EASY"
            ],
            [
                "marca" => "HEAD",
                "descripcion" => "SUPERSHAPE EASY JR"
            ],
            [
                "marca" => "HEAD",
                "descripcion" => "V - SHAPE  VR"
            ],
            [
                "marca" => "K2",
                "descripcion" => "KAN BLANCO Y ROSA"
            ],
            [
                "marca" => "KAN",
                "descripcion" => "JR"
            ],
            [
                "marca" => "KEMPER",
                "descripcion" => "DIVA"
            ],
            [
                "marca" => "LAMAR",
                "descripcion" => "BELLE"
            ],
            [
                "marca" => "LAMAR ",
                "descripcion" => "COLORADO TROOPER "
            ],
            [
                "marca" => "LAMAR",
                "descripcion" => "ESSENCE"
            ],
            [
                "marca" => "LAMAR",
                "descripcion" => "HUNTER"
            ],
            [
                "marca" => "LAMAR",
                "descripcion" => "ICIX"
            ],
            [
                "marca" => "LAMAR",
                "descripcion" => "PIXE"
            ],
            [
                "marca" => "LAMAR",
                "descripcion" => "TROOPER"
            ],
            [
                "marca" => "LAMAR",
                "descripcion" => "TROPPER"
            ],
            [
                "marca" => "LAMAR",
                "descripcion" => "VIPER"
            ],
            [
                "marca" => "LAMAR",
                "descripcion" => "VIPER NEGRA"
            ],
            [
                "marca" => "LTD",
                "descripcion" => "ANGEL"
            ],
            [
                "marca" => "LTD",
                "descripcion" => "DOLAR"
            ],
            [
                "marca" => "LTD",
                "descripcion" => "GEO"
            ],
            [
                "marca" => "LTD",
                "descripcion" => "GEO JR"
            ],
            [
                "marca" => "LTD ",
                "descripcion" => "MFG - WHITE & PINK "
            ],
            [
                "marca" => "LTD",
                "descripcion" => "MFG SINCE 1993"
            ],
            [
                "marca" => "LTD",
                "descripcion" => "PASCED JR "
            ],
            [
                "marca" => "LTD",
                "descripcion" => "PULSE"
            ],
            [
                "marca" => "LTD",
                "descripcion" => "RAIDER"
            ],
            [
                "marca" => "LTD",
                "descripcion" => "VENOM"
            ],
            [
                "marca" => "MORROW",
                "descripcion" => "LOTUS "
            ],
            [
                "marca" => "NITRO",
                "descripcion" => "ARIAL"
            ],
            [
                "marca" => "NITRO",
                "descripcion" => "BEAST BOSQUE"
            ],
            [
                "marca" => "NITRO",
                "descripcion" => "BRYAN AUSTIN"
            ],
            [
                "marca" => "NITRO",
                "descripcion" => "CHEAPTHRILLS"
            ],
            [
                "marca" => "NITRO",
                "descripcion" => "FATE"
            ],
            [
                "marca" => "NITRO",
                "descripcion" => "FUSION BLANCA"
            ],
            [
                "marca" => "NITRO",
                "descripcion" => "FUSION ROJA"
            ],
            [
                "marca" => "NITRO",
                "descripcion" => "MAGNUM"
            ],
            [
                "marca" => "NITRO",
                "descripcion" => "MYSTIQUE"
            ],
            [
                "marca" => "NITRO",
                "descripcion" => "MYSTIQUE CELESTE"
            ],
            [
                "marca" => "NITRO",
                "descripcion" => "MYSTIQUE NEGRO"
            ],
            [
                "marca" => "NITRO",
                "descripcion" => "PRIME  PRIME MCMXC VERDE VERDE"
            ],
            [
                "marca" => "NITRO",
                "descripcion" => "PRIME COLORES"
            ],
            [
                "marca" => "NITRO",
                "descripcion" => "PRIME NARANJA"
            ],
            [
                "marca" => "NITRO",
                "descripcion" => "PRIME WIDE"
            ],
            [
                "marca" => "NITRO",
                "descripcion" => "PRIME WIDE COLORES"
            ],
            [
                "marca" => "NITRO",
                "descripcion" => "RIPPER AMARILLO"
            ],
            [
                "marca" => "NITRO",
                "descripcion" => "RIPPER NARANJA JR"
            ],
            [
                "marca" => "NITRO",
                "descripcion" => "SMP"
            ],
            [
                "marca" => "NITRO",
                "descripcion" => "SMP COLORES"
            ],
            [
                "marca" => "NITRO",
                "descripcion" => "STANCE NARANJA Y CELESTE"
            ],
            [
                "marca" => "NITRO",
                "descripcion" => "STANCE NSBC "
            ],
            [
                "marca" => "NITRO",
                "descripcion" => "STANDARD NEGRO"
            ],
            [
                "marca" => "NITRO",
                "descripcion" => "TEAM CLASSIC"
            ],
            [
                "marca" => "NITRO",
                "descripcion" => "TEAM MCMXC"
            ],
            [
                "marca" => "NITRO",
                "descripcion" => "VICTORIA"
            ],
            [
                "marca" => "NITRO",
                "descripcion" => "VISUAL LIBERATION"
            ],
            [
                "marca" => "NORDICA",
                "descripcion" => "FREESTYLE MARKER "
            ],
            [
                "marca" => "RIDE",
                "descripcion" => "AGENDA"
            ],
            [
                "marca" => "ROSSIGNOL",
                "descripcion" => "CONTRAST"
            ],
            [
                "marca" => "SALOMON",
                "descripcion" => "TEAM  VERDE JR "
            ],
            [
                "marca" => "SALOMON",
                "descripcion" => "TEAM JR"
            ],
            [
                "marca" => "SALOMON",
                "descripcion" => "VIOLETA LARK"
            ],
            [
                "marca" => "SANTA CRUZ",
                "descripcion" => " TIGER "
            ],
            [
                "marca" => "SAPIENT",
                "descripcion" => "ROJA"
            ],
            [
                "marca" => "SAPIENT",
                "descripcion" => "VERDE JR"
            ],
            [
                "marca" => "SAPIENT",
                "descripcion" => "VIOLETA Y BLANCO"
            ],
            [
                "marca" => "SIMS",
                "descripcion" => "WRATH"
            ],
            [
                "marca" => "TECHNINE",
                "descripcion" => "TEAM BOTTLES "
            ],
            [
                "marca" => "TECHNINE",
                "descripcion" => "DO YOUR THING"
            ],
            [
                "marca" => "TECHNINE",
                "descripcion" => "GREEN LIGHT BLUE WMN"
            ],
            [
                "marca" => "TECHNINE",
                "descripcion" => "MUJERES"
            ],
            [
                "marca" => "TECHNINE",
                "descripcion" => "TT AUTOS "
            ]
        ];

        foreach ($modelos as $modelo) {
            $marca = Marca::where('descripcion', Str::trim($modelo["marca"]))->first();

            if ($marca == null) {
                dd($modelo);
            }

            Modelo::updateOrCreate([
                "descripcion" => Str::trim($modelo["descripcion"]),
                'marca_id' => $marca->id
            ]);
        }

        $marcas = Marca::all();

        foreach ($marcas as $marca) {
            Modelo::updateOrCreate([
                "descripcion" => "SIN MODELO ({$marca->descripcion})",
                'marca_id' => $marca->id
            ]);
        }
        
        // enable fk check
    }
}
