<table style="width:100%;max-width:620px;margin:0 auto;">
    <tbody>
        <tr>
            <td style="text-align: center; padding:25px 20px 0;">
                <p style="font-size: 13px;">Copyright © {{now()->format('Y')}} <a style="color: #9769ff; text-decoration:none;" href="{{env('APP_URL')}}">{{env('APP_NAME')}}</a>. All rights reserved.</p>
                <ul style="margin: 10px -4px 0;padding: 0;">
                     <li style="display: inline-block; list-style: none; padding: 4px;"><a style="display: inline-block; height: 30px; width:30px;border-radius: 50%; background-color: #ffffff" href="{{env('TWITTER_URL')}}"><img style="width: 30px" src="{{asset('assets/images/socials-svg/twitter.png')}}" alt="brand"></a></li>
                    <li style="display: inline-block; list-style: none; padding: 4px;"><a style="display: inline-block; height: 30px; width:30px;border-radius: 50%; background-color: #ffffff" href="{{env('INSTAGRAM_URL')}}"><img style="width: 30px" src="{{asset('assets/images/socials-svg/instagram.png')}}" alt="brand"></a></li>
                    <li style="display: inline-block; list-style: none; padding: 4px;"><a style="display: inline-block; height: 30px; width:30px;border-radius: 50%; background-color: #ffffff" href="{{env('FACEBOOK_URL')}}"><img style="width: 30px" src="{{asset('assets/images/socials-svg/facebook.png')}}" alt="brand"></a></li>
                </ul>
                <p style="padding-top: 15px; font-size: 12px;">This email was sent to you as a user of <a style="color: #6a29ff; text-decoration:none;" href="{{env('APP_URL')}}">{{env('APP_URL')}}</a>.</p>
            </td>
        </tr>
    </tbody>
</table>
</td>
</tr>
</table>
</center>
</body>
</html>