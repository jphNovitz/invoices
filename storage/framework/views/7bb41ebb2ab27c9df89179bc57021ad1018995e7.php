<!DOCTYPE html>

<html>

<head>

    <title><?php echo e(__('app.Invoice')); ?> <?php echo e($invoice['reference']); ?></title>
</head>


<style>
    body, section, article, table, #container{
        width: 100% !important;
        padding: 0 !important;
        margin: 0 !important;
    }
        /*article, section {*/
        /*    width: 100% !important;*/
        /*    padding: 0 !important;*/
        /*    margin: 0 !important;*/
        /*}*/

        section {
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
            width: 45%;
        }

        .left {
            width: 40%;
        }

        .right {
            width: 40%;
            font-weight: bold;
        }

        table {
            width: 100%;
            margin: 2rem auto;
        }

        td {
            padding: 1px 5px 1px 15px;
        }
</style>

<body>

<main id="container">
    <sections class="h1"><?php echo e(__('app.Invoice')); ?> <?php echo e($invoice['reference']); ?></sections>
        <ul class="justify-self-right">
            <li>Créée
                le: <?php echo e(\Carbon\Carbon::createFromTimestamp(strtotime($invoice->created_at))->format('d-m-Y h:i')); ?></li>
            <li>Modifiée
                le: <?php echo e(\Carbon\Carbon::createFromTimestamp(strtotime($invoice->updated_at))->format('d-m-Y h:i')); ?></li>
        </ul>
    <article>
        <table>
            <tr>
                <td class="left">
                    <ul>
                        <li><?php echo e($user->company); ?></strong> </li>
                        <li><?php echo e(__('auth.Vat')); ?>: <?php echo e($user->tva); ?> </li>
                        <li><?php echo e($user->lastname); ?> <?php echo e($user->firstname); ?></li>
                        <li><?php echo e($user->street); ?> <?php echo e($user->nr); ?> </li>
                        <li><?php echo e($user->city->code); ?> <?php echo e($user->city->city); ?></li>
                        <li><?php echo e($user->email); ?></li>
                        <li><?php echo e($user->phone); ?></li>
                    </ul>
                </td>
                <td class="right">
                    <ul class="rounded">
                        <li><?php echo e($invoice->client->company); ?></strong> </li>
                        <li><?php echo e(__('auth.Vat')); ?>: <?php echo e($invoice->client->tva); ?> </li>
                        <li><?php echo e($invoice->client->lastname); ?> <?php echo e($invoice->client->firstname); ?></li>
                        <li><?php echo e($invoice->client->street); ?> <?php echo e($invoice->client->nr); ?> </li>
                        <li><?php echo e($invoice->client->city->code); ?> <?php echo e($invoice->client->city->city); ?></li>
                        <li><?php echo e($invoice->client->email); ?></li>
                        <li><?php echo e($invoice->client->phone); ?></li>
                    </ul>
                </td>
            </tr>
        </table>
    </article>
    <article>
        <table style="border: solid 1px rgb(203 213 225)">
            <tr style="background-color:  rgb(30 41 59) ; color: white ; width: 100%">
                <th style="width: 40%">Description</th>
                <th>PU</th>
                <th>Qté</th>
                <th>TVA</th>
                <th>Réduc</th>
                <th>Total</th>
            </tr>
            <?php $__currentLoopData = $invoice->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr style="width: 100%">
                    <td style="width: 40%">
                        <?php echo e($item->description); ?>

                    </td>
                    <td>
                        <?php echo e($item->price); ?>

                    </td>
                    <td>
                        <?php echo e($item->qty); ?>

                    </td>
                    <td>
                        <?php $vat = \App\Vat::find($item->vat_id);
                        echo $item->qty * ($item->price * $vat->rate)
                        ?>
                    </td>
                    <td>
                        <?php echo e($item->discount); ?>

                    </td>
                    <td>
                        <?php echo $item->qty * ($item->price + ($item->price * $vat->rate) - $item->discount)?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
    </article>
</main>
</body>

</html><?php /**PATH /home/jiffy/dev/invoices/resources/views/Invoice/pdf.blade.php ENDPATH**/ ?>