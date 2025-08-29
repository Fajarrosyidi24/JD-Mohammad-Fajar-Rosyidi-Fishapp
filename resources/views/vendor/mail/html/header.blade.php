@props(['url'])

<tr>
<td class="header" style="padding: 20px 0; text-align: center; border-bottom: 1px solid #e5e7eb;">
    <a href="{{ $url }}" style="display: inline-flex; align-items: center; text-decoration: none;">
        {{-- Logo --}}
        <img src="https://instagram.fsub18-1.fna.fbcdn.net/v/t51.2885-19/489377213_18048031526605052_6754258558375590630_n.jpg?stp=dst-jpg_s150x150_tt6&efg=eyJ2ZW5jb2RlX3RhZyI6InByb2ZpbGVfcGljLmRqYW5nby40MDkuYzIifQ&_nc_ht=instagram.fsub18-1.fna.fbcdn.net&_nc_cat=108&_nc_oc=Q6cZ2QGVg_f8zlkO5b4qj1_wxag39w0jbAW3Mfza4ykKPDyQrlvXLoTxfRF9iq687zfNQpI&_nc_ohc=hbzKQ8O9rYkQ7kNvwFp7zwB&_nc_gid=4o_SjeEmU3M7i2qucQQd0Q&edm=AP4sbd4BAAAA&ccb=7-5&ig_cache_key=GL1NKx380AnMlh5AAOZ6Ho1f8rtdbvEnAQAB1501500j-ccb7-5&oh=00_AfVspALkfUFoAZMQC_k974oau6uIK-uTp2RPauyL1VPF7Q&oe=68A814BB&_nc_sid=7a9f4b" class="logo" alt="Logo" style="height: 40px; margin-right: 10px;">
        
        {{-- Nama Aplikasi --}}
        <span style="font-size: 20px; font-weight: bold; color: #1f2937;">
            {{ config('app.name') }}
        </span>
    </a>
</td>
</tr>