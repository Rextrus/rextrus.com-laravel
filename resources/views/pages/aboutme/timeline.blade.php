<!-- @extends('layouts.main') -->

@section('content')

<style>

    /* body {
        background: linear-gradient(180deg,#0d1017 9%,#353b43 23%,#717171) !important;
        background-repeat: no-repeat !important;
        background-attachment: fixed !important;
    } */
    .content-box {
        text-align: center;
        min-height: 80px;
        margin-bottom: 10px;
        border: 1px solid rgb(116, 116, 116);
        border-radius: 15px;
        background-color: rgba(0, 0, 0, 0.4);
    }

    #references h1 {
        color: rgba(255, 255, 255, 0.5);
        font-weight: bold;
        text-shadow: 2px 2px 5px #515151;
        font-family:  Papyrus;
    }

    #references .row {
        /* min-height: 300px; */
        margin-top: 30px;
    }

    #references .verticalLine {
        position: absolute;
        height: 2800px;
        width: 140px;
        border-right:rgb(116, 116, 116);
        border-right-style: solid;
    }

    #references .col-sm-8, .col-sm-2, .col-sm-1 {
        text-transform: none;
        color: rgba(255, 255, 255, 0.5);
        /* text-shadow: 2px 2px 5px #515151; */
    }

    #references a {
        color:rgba(119, 119, 119, 0.4)
    }

    #references .DottedBottom {
        border-top:rgba(255, 255, 255, 0.1);
        border-top-style: dotted;
    }

    #references .col-md-2 {
        top: 20px;
    }

    
    @media (max-width: 1000px) {
	    .hideTheLine {display:none;}
    }

</style>

<section id="references">
    <!--<div class="content-box">
        
    </div> -->
    <div class="verticalLine hideTheLine">
    </div>

    <div class="row">
        <div class="col-md-2">
            <h1>2023</h1>
        </div>

        <div class="col-md-10">
            <div class="row">
                <div class="col-sm-2">
                    March  
                </div>
                <div class="col-sm-1">
                    4th
                </div>
                <div class="col-sm-8">
                    <a href="https://youtu.be/pc_mtw0Ah0k" target="_blank">mp_glados Walkthrough | Vertex</a><br>Walkthrough of mp_glados Vertex Route.
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    January  
                </div>
                <div class="col-sm-1">
                    18th
                </div>
                <div class="col-sm-8">
                    This website (V2) was fully rebuild with a framework (Laravel).
                </div>
            </div>
        </div>
    </div>

    <div class="row DottedBottom">
        <div class="col-md-2" >
            <h1>2022</h1>
        </div>

        <div class="col-md-10">
            <div class="row">
                <div class="col-sm-2">
                    December 
                </div>
                <div class="col-sm-1">
                    7th
                </div>
                <div class="col-sm-8">
                    <a href="/cod4/map/mp_glados">mp_glados</a><br>Published a new route for mp_glados - Vertex.
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    July 
                </div>
                <div class="col-sm-1">
                    10th
                </div>
                <div class="col-sm-8">
                    <a href="https://youtu.be/fwOmbf70tNA" target="_blank">mp_dream Walkthrough | Challenge</a><br>Walkthrough of mp_dream Challenge Route.
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    June 
                </div>
                <div class="col-sm-1">
                    26th
                </div>
                <div class="col-sm-8">
                    <a href="https://youtu.be/2ionbLxSPpI" target="_blank">mp_dream Walkthrough | Classic Hard</a><br>Walkthrough of mp_dream Classic Hard Route.
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    February 
                </div>
                
                <div class="col-sm-1">
                    24th
                </div>
                <div class="col-sm-8">
                    <a href="/cod4/map/mp_dream">mp_dream</a><br>Published mp_dream.
                </div>
            </div>
        </div>

    </div>

    <div class="row DottedBottom">
        <div class="col-md-2" >
            <h1>2021</h1>
        </div>
        <div class="col-md-10">
            <div class="row">
                <div class="col-sm-2">
                    June
                </div>
                <div class="col-sm-1">
                    19th
                </div>
                <div class="col-sm-8">
                    <a href="https://www.youtube.com/watch?v=J8Js6Mal_sw" target="_blank">mp_hybrid Walkthrough</a><br>Walkthrough of mp_hybrid.
                </div>
            </div>  
            <div class="row">
                <div class="col-sm-2">
                    January
                </div>
                <div class="col-sm-1">
                    16th
                </div>
                <div class="col-sm-8">
                    <a href="https://www.youtube.com/watch?v=o3JFNl8yXcI" target="_blank">mp_ruins Walkthrough | Hard</a><br>Walkthrough of mp_ruins Hard Route.
                </div>
            </div>    
            <div class="row">
                <div class="col-sm-2">
                     
                </div>
                
                <div class="col-sm-1">
                    15th
                </div>
                <div class="col-sm-8">
                    <a href="/cod4/map/mp_ruins">mp_ruins</a><br>Published mp_ruins.
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    
                </div>
                <div class="col-sm-1">
                    1st
                </div>
                <div class="col-sm-8">
                    <a href="https://www.youtube.com/watch?v=TbTJjOqMDaU" target="_blank">mp_ruins Walkthrough | Advanced</a><br>Walkthrough of mp_ruins Advanced Route.
                </div>
            </div>       
        </div>

    </div>
    
    <div class="row DottedBottom">
        <div class="col-md-2" >
            <h1>2020</h1>
        </div>
    
        <div class="col-md-10">>
            <div class="row">
                <div class="col-sm-2">
                    December
                </div>
                <div class="col-sm-1">
                    26th
                </div>
                <div class="col-sm-8">
                    <a href="https://www.youtube.com/watch?v=B6069urBIQk" target="_blank">mp_ruins Teaser | Advanced</a><br>Teaser of mp_ruins Advanced Route.
                </div>
            </div>       
            <div class="row">
                <div class="col-sm-2">
                    June
                </div>
                <div class="col-sm-1">
                    23rd
                </div>
                <div class="col-sm-8">
                    <a href="https://www.youtube.com/watch?v=Fexce_o6KK8" target="_blank">mp_glados Walkthrough | Inter</a><br>Walkthrough of mp_glados Inter Route.
                </div>
            </div>  
            <div class="row">
                <div class="col-sm-2">
                     
                </div>
                <div class="col-sm-1">
                    15th
                </div>
                <div class="col-sm-8">
                    <a href="/cod4/map/mp_glados">mp_glados</a><br>Published mp_glados.
                </div>
            </div>    
            <div class="row">
                <div class="col-sm-2">
                     
                </div>
                <div class="col-sm-1">
                    12th
                </div>
                <div class="col-sm-8">
                    <a href="https://www.youtube.com/watch?v=_vXDd16OF_8" target="_blank">mp_glados Walkthrough | Advanced</a><br>Walkthrough of mp_glados Advanced Route.
                </div>
            </div>     
            <div class="row">
                <div class="col-sm-2">
                     
                </div>
                <div class="col-sm-1">
                    12th
                </div>
                <div class="col-sm-8">
                    <a href="https://www.youtube.com/watch?v=Icilch3_Ar0" target="_blank">mp_glados Walkthrough | Hard</a><br>Walkthrough of mp_glados Hard Route.
                </div>
            </div>         
            <div class="row">
                <div class="col-sm-2">
                    May 
                </div>
                <div class="col-sm-1">
                    14th
                </div>
                <div class="col-sm-8">
                    <a href="https://www.youtube.com/watch?v=EaNre57mP2Y" target="_blank">mp_lucid Walkthrough | Fun</a><br>Walkthrough of mp_lucid Fun Route.
                </div>
            </div>
        </div>

    </div>
    
    <div class="row DottedBottom">
        <div class="col-md-2" >
            <h1>2019</h1>
        </div>
    
        <div class="col-md-10">
            <div class="row">
                <div class="col-sm-2">
                    August
                </div>
                
                <div class="col-sm-1">
                    12th
                </div>
                <div class="col-sm-8">
                    First Launch of Rextrus.com
                </div>
            </div>
        </div>
    </div>
    
    <div class="row DottedBottom">
        <div class="col-md-2" >
            <h1>2018</h1>
        </div>

        <div class="col-md-10">
            <div class="row">
                <div class="col-sm-2">
                    January 
                </div>
                
                <div class="col-sm-1">
                    12th
                </div>
                <div class="col-sm-8">
                    <a href="/cod4/map/mp_the_extreme_v2">mp_the_extreme_v2</a><br>Published mp_the_extreme_v2.
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-1">
                    12th
                </div>
                <div class="col-sm-8">
                    <a href="https://www.youtube.com/watch?v=fIHoCz5Ottk" target="_blank">mp_the_extreme_V2 Walkthrough | Elevator</a><br> Call Of Duty 4 CoDJumper Walkthrough.
                </div>
            </div>



        </div>

    </div>
    
    <div class="row DottedBottom">
        <div class="col-md-2" >
            <h1>2017</h1>
        </div>

        <div class="col-md-10">
            <div class="row">
                <div class="col-sm-2">
                    January 
                </div>
                
                <div class="col-sm-1">
                    30th
                </div>
                <div class="col-sm-8">
                    <a href="https://www.youtube.com/watch?v=jr1FL90lHb0" target="_blank">bounce. </a><br> Call Of Duty 4 CoDJumper Edit.
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2">
                </div>
                
                <div class="col-sm-1">
                    17th
                </div>
                <div class="col-sm-8">
                    <a href="https://www.youtube.com/watch?v=BxSvDyvVPV8" target="_blank">mp_spirits Walkthrough | Inter </a><br> Call Of Duty 4 CoDJumper Walkthrough.
                </div>
            </div>

        </div>
    </div>
    
    <div class="row DottedBottom">
        <div class="col-md-2">
            <h1>2016</h1>
        </div>



        <div class="col-md-10">
            <div class="row">
                <div class="col-sm-2">
                    December 
                </div>
                
                <div class="col-sm-1">
                    1st
                </div>
                <div class="col-sm-8">
                    <a href="https://www.youtube.com/watch?v=td0Rxs-_SYo" target="_blank">CoDJumper NEW GAP WORLD RECORD 385 </a><br> Call Of Duty 4 CoDJumper Edit.
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-2">
                    November 
                </div>
                
                <div class="col-sm-1">
                    12th
                </div>
                <div class="col-sm-8">
                    <a href="https://www.youtube.com/watch?v=el07Ay-D91g" target="_blank">CoDJumper Montage on mp_Pizzahut_v2</a><br> Call Of Duty 4 CoDJumper Edit.
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2">
                    October 
                </div>
                
                <div class="col-sm-1">
                    20th
                </div>
                <div class="col-sm-8">
                    <a href="/cod4/map/mp_astral" target="_blank">mp_astral</a><br>Published my first CoDJumper map.
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2">
                     
                </div>
                
                <div class="col-sm-1">
                    20th
                </div>
                <div class="col-sm-8">
                    <a href="https://www.youtube.com/watch?v=15YM-1Q29rs" target="_blank">mp_astral - Walktrough [Hard]</a><br>CoDJumper walkthrough of mp_astral - Hard Route.
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2">
                     
                </div>
                
                <div class="col-sm-1">
                    20th
                </div>
                <div class="col-sm-8">
                    <a href="https://www.youtube.com/watch?v=vYHgUJ0Vc5Q" target="_blank">mp_astral - Walktrough [Easy]</a><br>CoDJumper walkthrough of mp_astral - Easy Route.
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2">
                    September 
                </div>
                
                <div class="col-sm-1">
                    19th
                </div>
                <div class="col-sm-8">
                    <a href="https://www.youtube.com/watch?v=mbMrWRIjrUc" target="_blank">im not the dragonborn :( (CodJumper & 60FPS)</a><br>Call of Duty 4 CoDJumper Edit.
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2">
                     
                </div>
                
                <div class="col-sm-1">
                    4th
                </div>
                <div class="col-sm-8">
                    <a href="https://www.youtube.com/watch?v=rPs08laBHkw" target="_blank">mp_ss_minecraft</a><br>Call of Duty 4 map for a mod called "Suicide Squad".
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-2">
                     
                </div>
                
                <div class="col-sm-1">
                    2nd
                </div>
                <div class="col-sm-8">
                    <a href="https://www.youtube.com/watch?v=28X5LpW84hc" target="_blank">mp_ss_detroit</a><br>Call of Duty 4 map for a mod called "Suicide Squad".
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-2">
                    August 
                </div>
                
                <div class="col-sm-1">
                    4th
                </div>
                <div class="col-sm-8">
                    <a href="https://www.moddb.com/mods/reign-of-the-undead-zombies/addons/mp-surv-harrypotter" target="_blank">mp_surv_harrypotter</a><br>My first RotU map.
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2">
                    June
                </div>
                <div class="col-sm-1">
                    20th
                </div>
                <div class="col-sm-8">
                    <a href="https://www.youtube.com/watch?v=9G1Yw283CkY" target="_blank">"Bunnyhops on mp_race by VC' Arkani | VC' CodJumper"</a><br>Call of Duty 4 CoDJumper Edit.
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-1">
                    18th
                </div>
                <div class="col-sm-8">
                    <a href="https://www.youtube.com/watch?v=kG1xmC4YJuI" target="_blank">"Bunnyhop on mp_sphere by VC' Leng | VC' CodJumper"</a><br>Call of Duty 4 CoDJumper Edit.
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2">
                    February
                </div>
                
                <div class="col-sm-1">
                    18th
                </div>
                <div class="col-sm-8">
                    <a href="https://www.youtube.com/watch?v=rLdHt83aO0E" target="_blank">"Bunnyhop on mp_galaxy by VC' Arkani"</a><br>Call of Duty 4 CoDJumper Edit.
                </div>
            </div>
        </div>
    </div>
</section>



@endsection