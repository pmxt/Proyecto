<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha de Vigilancia de la Embarazada</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0%;
        }

        .container {
            max-width: 1000px;
            margin: auto;
        }

        .title {
            text-align: center;
            font-weight: bold;
            font-size: 12px;
        }

        .section {
            margin-top: 5px;
        }

        .section-title {
            font-weight: bold;
            margin-bottom: 0%;
            font-size: 10px;
            text-align: center;
        }

        .field-group {
            margin-bottom: 15px;
            font-size: 12px;
        }

        table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        td {
            font-size: 12px;
            padding: 3px;
        }

        td.no-border {
            border: none;
        }

        td.border {
            border: 1px solid black;
        }

        .center-text {
            text-align: center;
            font-size: 12px;
        }

        .black-background {
            background-color: black;
            color: white;
            text-align: right;
            padding: 0px;
            font-weight: bold;
            font-size: 12px;
        }

        .fiel {
            text-align: right;
        }

        @media print {
            @page {
                size: legal; 
                
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="black-background">Vigilancia de la embarazada y de muerte de mujeres en edad fértil</div>
        <div class="black-background">(10 a 54 años) para identificación de las muertes maternas</div>
        <div class="title">Ficha de vigilancia de la embarazada</div>
        <div class="title">Ministerio de Salud Pública y Asistencia Social</div>
        <div class="title"> Centro Nacional de Epidemiología</div>
        <div class="title"> _________________________________________</div>
        <div class="section">
            <table>
                <tr>
                    <td class="label">Registro No.: &nbsp;&nbsp;{{ $paciente->cui }}</td>
                    
                </tr>
                <tr>
                    <td class="label">Nombre de la embarazada:&nbsp;&nbsp;{{ $paciente->name }}</td>
                    <td class="label">Edad en años: &nbsp;&nbsp;{{ $paciente->edad }}</td>
                    
                </tr>
                <tr>
                    <td class="label">Escolaridad: &nbsp;&nbsp; {{ $paciente->Escolaridad }}</td>
                    <td class="label">Ocupación: &nbsp;&nbsp;{{ $paciente->Ocupacion }}</td>
                    
                </tr>
                <tr>
                    <td class="label"> Nombre del esposo o conviviente:&nbsp;&nbsp; {{ $encargado->nombreEsposo }}</td>
                    
                    <td class="label">Edad en años: &nbsp;&nbsp;{{ $encargado->edad }}</td>
                    
                </tr>
                <tr>
                    <td class="label">Escolaridad: &nbsp;&nbsp;{{ $encargado->Escolaridad }}</td>
                    
                    <td class="label">Ocupación: &nbsp;&nbsp; {{ $encargado->Ocupacion }} </td>
                    
                </tr>
                <tr>
                    <td class="label">Distancia al servicio de salud más cercano:&nbsp;&nbsp; {{ $paciente->distancia }} Kms.</td>
                    
                    <td class="label">Tiempo en horas para llegar:&nbsp;&nbsp;{{ $paciente->tiempo }}</td>
                   
                </tr>
                <tr>
                    <td class="label">Nombre de la comunidad:&nbsp;&nbsp; {{ $paciente->comunidad }}</td>
                    
                </tr>
                <tr>
                    <td class="label">No. de celular de la señora o pareja comunitaria:&nbsp;&nbsp; {{ $paciente->telefono }}</td>
                    
                </tr>
                <tr>
                    <td class="label">Fecha de última regla:&nbsp;&nbsp; {{ $embarazo->fecha_ultima_regla }}</td>
                    
                    <td class="label">Fecha probable de parto:&nbsp;&nbsp; {{ $embarazo->fecha_probable_parto }}</td>
                    
                </tr>
                <tr>
                    <td class="label">No. de partos:&nbsp;&nbsp;{{ $antecedentesObstetricos->num_partos }}</td>
                  
                    <td class="label">No. de cesáreas: &nbsp;&nbsp;{{ $antecedentesObstetricos->num_cesarias }} </td>
                   
                </tr>
                <tr>
                    <td class="label">No. de hijos vivos:&nbsp;&nbsp;{{ $antecedentesObstetricos->num_hijos_vivos }}</td>
                    
                    <td class="label">No. de hijos muertos:&nbsp;&nbsp;{{ $antecedentesObstetricos->num_hijos_nacidos_muertos }}</td>
                </tr>
            </table>
        </div>
    </div>


        <div class="section">
            <div class="section-title">ANTECEDENTES OBSTÉTRICOS</div>
            <table>
                <tr>
                    <td class="no-border"></td>
                    <td class="no-border">SI</td>
                    <td class="no-border">NO</td>
                </tr>
                <tr>
                    <td class="no-border">1. Muerte fetal o neonatal previas</td>
                    <td class="center-text border">{{ $antecedentesObstetricos->muerte_fetal ? 'X' : '' }}</td>
                    <td class="center-text border">{{ !$antecedentesObstetricos->muerte_fetal ? 'X' : '' }}</td>
                </tr>
                <tr>
                    <td class="no-border">2. Antecedentes de 3 o más abortos espontáneos consecutivos</td>
                    <td class="center-text border">{{ $antecedentesObstetricos->abortos_consecutivos ? 'X' : '' }}</td>
                    <td class="center-text border">{{ !$antecedentesObstetricos->abortos_consecutivos ? 'X' : '' }}</td>
                </tr>
                <tr>
                    <td class="no-border">3. Antecedentes de 0 o más gestas</td>
                    <td class="center-text border">{{ $antecedentesObstetricos->num_embarazos >= 6 ? 'X' : '' }}</td>
                    <td class="center-text border">{{ $antecedentesObstetricos->num_embarazos < 6 ? 'X' : '' }}</td>
                </tr>
                <tr>
                    <td class="no-border">4. Peso al nacer del último bebé &lt; 2500 g (5 lbs 8 onzas)</td>
                    <td class="center-text border">{{ $antecedentesObstetricos->peso_bebe_2500g ? 'X' : '' }}</td>
                    <td class="center-text border">{{ !$antecedentesObstetricos->peso_bebe_2500g ? 'X' : '' }}</td>
                </tr>
                <tr>
                    <td class="no-border">5. Peso al nacer del último bebé &gt; 4500 g (9 lbs 9 onzas)</td>
                    <td class="center-text border">{{ $antecedentesObstetricos->peso_bebe_4500g ? 'X' : '' }}</td>
                    <td class="center-text border">{{ !$antecedentesObstetricos->peso_bebe_4500g ? 'X' : '' }}</td>
                </tr>
                <tr>
                    <td class="no-border">6. Antecedentes de hipertensión o preeclampsia/eclampsia</td>
                    <td class="center-text border">{{ $antecedentesObstetricos->hipertension ? 'X' : '' }}</td>
                    <td class="center-text border">{{ !$antecedentesObstetricos->hipertension ? 'X' : '' }}</td>
                </tr>
                <tr>
                    <td class="no-border">7. Cirugías previas en el tracto reproductivo (miomectomía, conización, cesárea o cerclaje cervical)</td>
                    <td class="center-text border">{{ $antecedentesObstetricos->cirugias_reproductor ? 'X' : '' }}</td>
                    <td class="center-text border">{{ !$antecedentesObstetricos->cirugias_reproductor ? 'X' : '' }}</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title">EMBARAZO ACTUAL</div>
            <table>
                <tr>
                    <td class="no-border"></td>
                    <td class="no-border">SI</td>
                    <td class="no-border">NO</td>
                </tr>
                <tr>
                    <td class="no-border">8. Diagnóstico o sospecha de embarazo múltiple</td>
                    <td class="center-text border">{{ $embarazo->embarazo_multiple ? 'X' : '' }}</td>
                    <td class="center-text border">{{ !$embarazo->embarazo_multiple ? 'X' : '' }}</td>
                </tr>
                <tr>
                    <td class="no-border">9. Menos de 20 años</td>
                    <td class="center-text border">{{ $embarazo->menos_20 ? 'X' : '' }}</td>
                    <td class="center-text border">{{ !$embarazo->menos_20 ? 'X' : '' }}</td>
                </tr>
                <tr>
                    <td class="no-border">10. Paciente Rh (-)</td>
                    <td class="center-text border">{{ $embarazo->rh_negativo ? 'X' : '' }}</td>
                    <td class="center-text border">{{ !$embarazo->rh_negativo ? 'X' : '' }}</td>
                </tr>
                <tr>
                    <td class="no-border">11. Más de 35 años</td>
                    <td class="center-text border">{{ $embarazo->mas_35 ? 'X' : '' }}</td>
                    <td class="center-text border">{{ !$embarazo->mas_35 ? 'X' : '' }}</td>
                </tr>
                <tr>
                    <td class="no-border">12. Hemorragia vaginal sin importar cantidad</td>
                    <td class="center-text border">{{ $embarazo->hemorragia ? 'X' : '' }}</td>
                    <td class="center-text border">{{ !$embarazo->hemorragia ? 'X' : '' }}</td>
                </tr>
                <tr>
                    <td class="no-border">13. VIH positivo o sífilis positivo</td>
                    <td class="center-text border">{{ $embarazo->vih_sifilis ? 'X' : '' }}</td>
                    <td class="center-text border">{{ !$embarazo->vih_sifilis ? 'X' : '' }}</td>
                </tr>
                <tr>
                    <td class="no-border">14. Presión arterial diastólica de 90 mm hg o más durante el registro de datos</td>
                    <td class="center-text border">{{ $embarazo->presion_arterial ? 'X' : '' }}</td>
                    <td class="center-text border">{{ !$embarazo->presion_arterial ? 'X' : '' }}</td>
                </tr>
                <tr>
                    <td class="no-border">15. Anemia clínica o de laboratorio</td>
                    <td class="center-text border">{{ $embarazo->anemia ? 'X' : '' }}</td>
                    <td class="center-text border">{{ !$embarazo->anemia ? 'X' : '' }}</td>
                </tr>
                <tr>
                    <td class="no-border">16. Desnutrición u obesidad</td>
                    <td class="center-text border">{{ $embarazo->desnutricion ? 'X' : '' }}</td>
                    <td class="center-text border">{{ !$embarazo->desnutricion ? 'X' : '' }}</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title">HISTORIA CLÍNICA GENERAL</div>
            <table>
                <tr>
                    <td class="no-border"></td>
                    <td class="no-border">SI</td>
                    <td class="no-border">NO</td>
                </tr>
                <tr>
                    <td class="no-border">17. Diabetes</td>
                    <td class="center-text border">{{ $historialClinico->diabetes_a ? 'X' : '' }}</td>
                    <td class="center-text border">{{ !$historialClinico->diabetes_a ? 'X' : '' }}</td>
                </tr>
                <tr>
                    <td class="no-border">18. Enfermedad renal</td>
                    <td class="center-text border">{{ $historialClinico->renal_a ? 'X' : '' }}</td>
                    <td class="center-text border">{{ !$historialClinico->renal_a ? 'X' : '' }}</td>
                </tr>
                <tr>
                    <td class="no-border">19. Enfermedad del corazón</td>
                    <td class="center-text border">{{ $historialClinico->corazon_a ? 'X' : '' }}</td>
                    <td class="center-text border">{{ !$historialClinico->corazon_a ? 'X' : '' }}</td>
                </tr>
                <tr>
                    <td class="no-border">20. Hipertensión arterial</td>
                    <td class="center-text border">{{ $historialClinico->hipertension_a ? 'X' : '' }}</td>
                    <td class="center-text border">{{ !$historialClinico->hipertension_a ? 'X' : '' }}</td>
                </tr>
                <tr>
                    <td class="no-border">21. Consumo de drogas incluido alcohol o tabaco</td>
                    <td class="center-text border">{{ $historialClinico->drogas_a ? 'X' : '' }}</td>
                    <td class="center-text border">{{ !$historialClinico->drogas_a ? 'X' : '' }}</td>
                </tr>
                <tr>
                    <td class="no-border">22. Cualquier otra enfermedad o afección médica severa</td>
                    <td class="center-text border">{{ $historialClinico->otra_a ? 'X' : '' }}</td>
                    <td class="center-text border">{{ !$historialClinico->otra_a ? 'X' : '' }}</td>
                </tr>
            </table>
            <div class="field-group">
                <label>Por favor, especifique: ________________________________________________________________________________________</label>
                <label>__________________________________________________________________________________________________________</label>
            </div>
        </div>
        <label class="field-group"> La presencia de algunas de las caracteristica anteriores hace necesario el seguimiento de la paciente en un servicio de salud con</label>
        <label class="field-group">capacidad resolutiva adecuada</label>
        <div class="section">
            <div class="field-group">
                <label>¿Es elegible? <b>SI</b> {{ $historialClinico->elegible ? 'X' : '' }} &nbsp;&nbsp; <b>NO</b> {{ !$historialClinico->elegible ? 'X' : '' }}&nbsp;&nbsp;</label>
            </div>
            <div class="field-group">
                <label>Si la respuesta es NO, será derivada a: {{ $historialClinico->referido_a }}</label>
            </div>
            <div class="field-group">
                <label>Fecha: &nbsp;&nbsp; {{ $historialClinico->fecha }} &nbsp;&nbsp; </label>
                <label>Nombre: &nbsp;&nbsp;  {{ $paciente->name }} &nbsp;&nbsp; </label>
                <label>Persona responsable:&nbsp;&nbsp;  {{ $historialClinico->responsable }}</label>


                
            </div>
        </div>
    </div>

</body>

</html>
