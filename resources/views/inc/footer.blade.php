<div class="container">
  <footer class="py-3 my-4">
    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
      <li class="nav-item"><a href="/cod4/serverlist" class="nav-link px-2 text-muted">servers</a></li>
      <li class="nav-item"><a href="/cod4/map" class="nav-link px-2 text-muted">maps</a></li>
      <li class="nav-item"><a href="/cod4/player" class="nav-link px-2 text-muted">players</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">other</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">contact</a></li>
    </ul>
    <p class="text-center text-muted">&copy; @php echo date("Y"); @endphp Rextrus.com</p>
  </footer>
</div>

@php

use App\Models\stats\IP;
use App\Models\stats\IPCount;

$remoteIP = $_SERVER["HTTP_X_FORWARDED_FOR"];
$abortIPStatistic = false;
$date = date('Y-m-d');

if(str_starts_with($remoteIP, '172.')) 
{
    for($i = 16; $i < 32; $i++) 
    {
        if(str_starts_with($remoteIP, '172.' . $i . '.')) 
        {
            $abortIPStatistic = true;
        } 
    }
}
if(str_starts_with($remoteIP, '10.') || str_starts_with($remoteIP, '192.168.')) 
{
    $abortIPStatistic = true;
}

if($remoteIP == "10.13.37.129")
    $abortIPStatistic = false;

if(!$abortIPStatistic) 
{
    $checkEntries = IP::where('ipaddress', $remoteIP)->first();
    if($checkEntries != null && $checkEntries->id) 
    {
        $checkCounterEntry = IPCount::where('id_web_stats_ip', $checkEntries->id)->first();
        if($checkCounterEntry) 
        {
            if($date != date('Y-m-d', strtotime($checkCounterEntry->updated_at))) 
            {
                $checkCounterEntry->increment('count');
            }
            $checkCounterEntry->increment('countTotal');
        }
    }
    // If person is not in database yet, create it
    else 
    {
        $country = "unknown";
        $countryCode = "unknown";

        $url = "http://ip-api.com/json/" . $remoteIP . "?fields=status,country,countryCode";
        $json = file_get_contents($url);
        $obj = json_decode($json);
        
        if($obj != null && $obj->status != "fail") 
        {
            $country = $obj->country; 
            $countryCode = $obj->countryCode;
        }

        $iptrack = new IP;
        $iptrack->ipaddress = $remoteIP;
        $iptrack->country = $country;
        $iptrack->countryCode = $countryCode;
        $iptrack->save();

        $checkEntries = IP::where('ipaddress', $remoteIP)->first();
        $counter = new IPCount;
        $counter->id_web_stats_ip = $checkEntries->id;
        $counter->save();
    }
}

@endphp