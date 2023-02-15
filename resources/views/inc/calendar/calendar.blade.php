BEGIN:VCALENDAR<br>
VERSION:2.0<br>
CALSCALE:GREGORIAN<br>
@foreach($data as $el)
    BEGIN:VEVENT<br>
    SUMMARY:{{ Str::limit($el->name, 50) }}<br>
    DTSTART;TZID=Europe/Moscow:@php    
    $datetime = new DateTime($el->date['value']);
    echo date_format($datetime,"Ymd");
    echo "T";
    echo date_format($datetime,"His");
    @endphp<br>
    DTEND;TZID=Europe/Moscow:@php   
    $oldDate = date('Y-m-d H:i:s', strtotime($el->date['value']. ' + 30 minutes'));
    $datetime2 = new DateTime($oldDate);
    echo date_format($datetime2,"Ymd");
    echo "T";
    echo date_format($datetime2,"His");
    @endphp<br>
    LOCATION:Crimea<br>
    DESCRIPTION: {{ Str::limit($el->description, 50) }}<br>
    COLOR:turquoise
    STATUS:CONFIRMED<br>
    SEQUENCE:3<br>
    BEGIN:VALARM<br>
    TRIGGER:-PT10M<br>
    DESCRIPTION:Напоминалка<br>
    ACTION:DISPLAY<br>
    END:VALARM<br>
    END:VEVENT<br>
@endforeach
END:VCALENDAR<br>