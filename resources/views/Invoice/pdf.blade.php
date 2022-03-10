<!DOCTYPE html>

<html>

<head>

    <title>{{__('app.Invoice')}} {{$invoice['reference']}}</title>
</head>

<style>
    #container {
        width: 95%;
        padding: 10px;
    }

    header {
        color: rgb(30 41 59);
        font-size: 1.6rem;
        border-bottom: solid 1px rgb(203 213 225);
    }

    ul {
        padding-left: 0;
    }

    ul li {
        list-style-type: none;
    }

    .rounded {
        border: solid 1px rgb(203 213 225);
        border-radius: 20px;
        padding: 3rem;
        width: max-content;
    }

    .left {
        width: 40%;
    }
    .right{
        width: 40%;
        font-weight: bold;
    }

    table {
        width: 100%;
        margin: 2rem auto;
    }

    td{
        padding: 1px 5px 1px 15px;
    }
</style>

<body>

<main id="container">
    <header class="h1">{{__('app.Invoice')}} {{$invoice['reference']}}</header>
    <aside>
        <ul class="justify-self-right">
            <li>Créée
                le: {{ \Carbon\Carbon::createFromTimestamp(strtotime($invoice->created_at))->format('d-m-Y h:i')}}</li>
            <li>Modifiée
                le: {{ \Carbon\Carbon::createFromTimestamp(strtotime($invoice->updated_at))->format('d-m-Y h:i')}}</li>
        </ul>
    </aside>
    <table>
        <tr>
            <td class="left">
                <ul>
                    <li>{{$user->company}}</strong> </li>
                    <li>{{__('auth.Vat')}}: {{$user->tva}} </li>
                    <li>{{$user->lastname}} {{$user->firstname}}</li>
                    <li>{{$user->street}} {{$user->nr}} </li>
                    <li>{{$user->city->code}} {{$user->city->city}}</li>
                    <li>{{$user->email}}</li>
                    <li>{{$user->phone}}</li>
                </ul>
            </td>
            <td class="right">
                <ul class="rounded">
                    <li>{{$invoice->client->company}}</strong> </li>
                    <li>{{__('auth.Vat')}}: {{$invoice->client->tva}} </li>
                    <li>{{$invoice->client->lastname}} {{$invoice->client->firstname}}</li>
                    <li>{{$invoice->client->street}} {{$invoice->client->nr}} </li>
                    <li>{{$invoice->client->city->code}} {{$invoice->client->city->city}}</li>
                    <li>{{$invoice->client->email}}</li>
                    <li>{{$invoice->client->phone}}</li>
                </ul>
            </td>
        </tr>
    </table>

    <table style="border: solid 1px rgb(203 213 225)">
        <tr style="background-color:  rgb(30 41 59) ; color: white ; width: 100%">
            <th  style="width: 40%">Description</th>
            <th>PU</th>
            <th>Qté</th>
            <th>TVA</th>
            <th>Réduc</th>
            <th>Total</th>
        </tr>
        @foreach($invoice->items as $item)
            <tr style="width: 100%">
                <td style="width: 40%">
                    {{$item->description}}
                </td>
                <td>
                    {{$item->price}}
                </td>
                <td>
                    {{$item->qty}}
                </td>
                <td>
                    <?php $vat = \App\Vat::find($item->vat_id);
                    echo $item->qty * ($item->price * $vat->rate)
                    ?>
                </td>
                <td>
                    {{$item->discount}}
                </td>
                <td>
                    <?php echo $item->qty * ($item->price + ($item->price * $vat->rate) - $item->discount)?>
                </td>
            </tr>
        @endforeach
    </table>
</main>
</body>

</html>