var toggleLanding = 0;
function switchForm()
{
    if(toggleLanding==0)
    {
        $('#login').css('visibility','hidden');
        $('#register').css('visibility','visible');
        toggleLanding=1;
    }
    else
    {
        $('#register').css('visibility','hidden');
        $('#login').css('visibility','visible');
        toggleLanding=0;
    }
}