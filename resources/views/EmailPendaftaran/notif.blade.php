<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">

    <!-- Mobile Responsive -->
    <style>
        @media only screen and (max-width: 600px) {
            .inner-body {
                width: 100% !important;
            }

            .footer {
                width: 100% !important;
            }
        }

        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }
    </style>
</head>

<body>
    <tr>
        <td class="header" style="padding: 20px 0; text-align: center; border-bottom: 1px solid #e5e7eb;">
            <div style="display: inline-flex; align-items: center;">
                {{-- Logo --}}
                <img src="https://instagram.fsub18-1.fna.fbcdn.net/v/t51.2885-19/489377213_18048031526605052_6754258558375590630_n.jpg?stp=dst-jpg_s150x150_tt6&efg=eyJ2ZW5jb2RlX3RhZyI6InByb2ZpbGVfcGljLmRqYW5nby40MDkuYzIifQ&_nc_ht=instagram.fsub18-1.fna.fbcdn.net&_nc_cat=108&_nc_oc=Q6cZ2QGVg_f8zlkO5b4qj1_wxag39w0jbAW3Mfza4ykKPDyQrlvXLoTxfRF9iq687zfNQpI&_nc_ohc=hbzKQ8O9rYkQ7kNvwFp7zwB&_nc_gid=4o_SjeEmU3M7i2qucQQd0Q&edm=AP4sbd4BAAAA&ccb=7-5&ig_cache_key=GL1NKx380AnMlh5AAOZ6Ho1f8rtdbvEnAQAB1501500j-ccb7-5&oh=00_AfVspALkfUFoAZMQC_k974oau6uIK-uTp2RPauyL1VPF7Q&oe=68A814BB&_nc_sid=7a9f4b"
                    class="logo" alt="Logo" style="height: 40px; margin-right: 10px;">

                {{-- Nama Aplikasi --}}
                <span style="font-size: 20px; font-weight: bold; color: #1f2937;">
                    {{ config('app.name') }}
                </span>
            </div>
        </td>
    </tr>

    <div class="container">
        <div class="header">
            <h1>Pendaftaran Akuni</h1>
        </div>
        <h2>Halo!</h2>
        <p>Anda menerima email ini karena kami menerima permintaan Anda untuk bergabung dengan tim  {{ config('app.name') }}</p>
        <p>Selamat! Kami telah menerima permintaan Anda.</p>
        <p>Silakan klik tombol di bawah ini untuk melakukan proses pendaftaran.</p>
        <p><a href="{{ $url }}">Verifikasi</a></p>
    </div>

    <tr>
  <td>
    <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
      <tr>
        <td class="content-cell" align="center" style="padding: 20px 0; border-top: 1px solid #eaeaea; font-size: 12px; color: #999; text-align: center;">
          <p style="margin: 0; color: #666;">
            © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
          </p>
          <p style="margin: 5px 0 0; font-size: 11px; color: #aaa;">
            Alamat: Jl. Raya Contoh No. 123, Banyuwangi
          </p>
          <p style="margin: 10px 0 0;">
            <a href="https://facebook.com" style="margin: 0 5px; color: #1a73e8;">Facebook</a> •
            <a href="https://twitter.com" style="margin: 0 5px; color: #1a73e8;">Twitter</a> •
            <a href="https://instagram.com" style="margin: 0 5px; color: #1a73e8;">Instagram</a>
          </p>
        </td>
      </tr>
    </table>
  </td>
</tr>
</body>
</html>
