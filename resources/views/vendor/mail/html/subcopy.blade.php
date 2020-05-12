<table class="subcopy" width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td>
            {!! Illuminate\Mail\Markdown::parse(str_replace('password/reset','public/index.php/password/reset',$slot)) !!}
        </td>
    </tr>
</table>
