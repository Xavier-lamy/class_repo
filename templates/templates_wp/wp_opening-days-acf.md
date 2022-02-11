# Retourner les jours d'ouverture en fonction des horaires d'un ACF

```php
<?php if(!empty(get_field('schedule_open_activate'))): ?>
<div class="col-12 text-center">

    <h2 class="mb-5 mx-3">
        Notre établissement


        <?php if(!empty(get_field('schedule_open_activate'))){
            $lundi = get_field('schedule_open_1');
            $mardi = get_field('schedule_open_2');
            $mercredi = get_field('schedule_open_3');
            $jeudi = get_field('schedule_open_4');
            $vendredi = get_field('schedule_open_5');
            $samedi = get_field('schedule_open_6');
            $dimanche = get_field('schedule_open_7');
            $closed_array = array('Fermé', 'fermé', '', 'closed');
            $days_array = array(
                array($lundi, 'monday'),
                array($mardi, 'tuesday'),
                array($mercredi, 'wednesday'),
                array($jeudi, 'thursday'),
                array($vendredi, 'friday'),
                array($samedi, 'saturday'),
                array($dimanche, 'sunday')     
            );
            $days_off = 0;
            foreach($days_array as $day){
                if(in_array($day[0][$day[1].'_morning_open'], $closed_array) && in_array($day[0][$day[1].'_afternoon_open'], $closed_array)){
                    $days_off += 1;
                }
                else {
                    $days_off += 0;
                }
            }

            if($days_off === 0){
                echo '<br> vous accueille tous les jours';
            }
            elseif($days_off === 7) {
                echo "<br> n'est pas ouvert";
            }
            else {       
                echo '<br> vous accueille';
                //Check first opened day
                $first_open_day = 1;
                switch (false) {
                    case (in_array($lundi['monday_morning_open'], $closed_array)):
                        echo ' du Lundi';
                        $first_open_day = 1;
                        break;
                    
                    case (in_array($lundi['monday_afternoon_open'], $closed_array)):
                        echo ' du Lundi';
                        $first_open_day = 1;
                        break;

                    case (in_array($mardi['tuesday_morning_open'], $closed_array)):
                        echo ' du Mardi';
                        $first_open_day = 2;
                        break;

                    case (in_array($mardi['tuesday_afternoon_open'], $closed_array)):
                        echo ' du Mardi';
                        $first_open_day = 2;
                        break;

                    case (in_array($mercredi['wednesday_morning_open'], $closed_array)):
                        echo ' du Mercredi';
                        $first_open_day = 3;
                        break;

                    case (in_array($mercredi['wednesday_afternoon_open'], $closed_array)):
                        echo ' du Mercredi';
                        $first_open_day = 3;
                        break;

                    case (in_array($jeudi['thursday_morning_open'], $closed_array)):
                        echo ' du Jeudi';
                        $first_open_day = 4;
                        break;

                    case (in_array($jeudi['thursday_afternoon_open'], $closed_array)):
                        echo ' du Jeudi';
                        $first_open_day = 4;
                        break;
                    
                    case (in_array($vendredi['friday_morning_open'], $closed_array)):
                        echo ' du Vendredi';
                        $first_open_day = 5;
                        break;

                    case (in_array($vendredi['friday_afternoon_open'], $closed_array)):
                        echo ' du Vendredi';
                        $first_open_day = 5;
                        break;

                    case (in_array($samedi['saturday_morning_open'], $closed_array)):
                        echo ' du Samedi';
                        $first_open_day = 6;
                        break;

                    case (in_array($samedi['saturday_afternoon_open'], $closed_array)):
                        echo ' du Samedi';
                        $first_open_day = 6;
                        break;
        
                    default:
                        echo ' du Dimanche';
                        $first_open_day = 7;
                        break;
                }
                //Check last opened day
                $last_open_day = 1;
                switch (true) {
                       

                    case (in_array($mardi['tuesday_morning_open'], $closed_array) && in_array($mardi['tuesday_afternoon_open'], $closed_array)):
                        echo ' au Lundi';
                        $last_open_day = 1;
                        break;

                    case (in_array($mercredi['wednesday_morning_open'], $closed_array) && in_array($mercredi['wednesday_afternoon_open'], $closed_array)):
                        echo ' au Mardi';
                        $last_open_day = 2;
                        break;

                    case (in_array($jeudi['thursday_morning_open'], $closed_array) && in_array($jeudi['thursday_afternoon_open'], $closed_array)):
                        echo ' au Mercredi';
                        $last_open_day = 3;
                        break;
                    
                    case (in_array($vendredi['friday_morning_open'], $closed_array) && in_array($vendredi['friday_afternoon_open'], $closed_array)):
                        echo ' au Jeudi';
                        $last_open_day = 4;
                        break;

                    case (in_array($samedi['saturday_morning_open'], $closed_array) && in_array($samedi['saturday_afternoon_open'], $closed_array)):
                        echo ' au Vendredi';
                        $last_open_day = 5;
                        break;                    
                        
                    case (in_array($dimanche['sunday_morning_open'], $closed_array) && in_array($dimanche['sunday_afternoon_open'], $closed_array)):
                        echo ' au Samedi';
                        $last_open_day = 6;
                        break; 
        
                    default:
                        echo ' au Dimanche';
                        $last_open_day = 7;
                        break;
                }
                //Check if day off is in middle of week
                $opened_days = ($last_open_day - $first_open_day) + 1;
                if($opened_days != (7 - $days_off)){
                    echo '<br>';
                    //Select first day after day off
                    switch (true) {    
                        case (in_array($mardi['tuesday_morning_open'], $closed_array) && in_array($mardi['tuesday_afternoon_open'], $closed_array)):{
                            switch (false) {
                                case (in_array($mercredi['wednesday_morning_open'], $closed_array)):
                                    echo 'et du Mercredi';
                                    break;

                                case (in_array($mercredi['wednesday_afternoon_open'], $closed_array)):
                                    echo 'et du Mercredi';
                                    break;
            
                                case (in_array($jeudi['thursday_morning_open'], $closed_array)):
                                    echo 'et du Jeudi';
                                    break;

                                case (in_array($jeudi['thursday_afternoon_open'], $closed_array)):
                                    echo 'et du Jeudi';
                                    break;
                                
                                case (in_array($vendredi['friday_morning_open'], $closed_array)):
                                    echo 'et du Vendredi';
                                    break;

                                case (in_array($vendredi['friday_afternoon_open'], $closed_array)):
                                    echo 'et du Vendredi';
                                    break;
            
                                case (in_array($samedi['saturday_morning_open'], $closed_array)):
                                    echo 'et du Samedi';
                                    break;

                                case (in_array($samedi['saturday_afternoon_open'], $closed_array)):
                                    echo 'et du Samedi';
                                    break;
                    
                                default:
                                    echo 'et le Dimanche,';
                                    $only_one_day = true;
                                    break;
                            }
                            if(!$only_one_day){
                                switch (true) {
                                    case (in_array($vendredi['friday_morning_open'], $closed_array) && in_array($vendredi['friday_afternoon_open'], $closed_array)):
                                        echo ' au Jeudi,';
                                        break;
                
                                    case (in_array($samedi['saturday_morning_open'], $closed_array) && in_array($samedi['saturday_afternoon_open'], $closed_array)):
                                        echo ' au Vendredi,';
                                        break;

                                    case (in_array($dimanche['sunday_morning_open'], $closed_array) && in_array($dimanche['sunday_afternoon_open'], $closed_array)):
                                        echo ' au Samedi,';
                                        break;
                        
                                    default:
                                        echo ' au Dimanche,';
                                        break;
                                }                                
                            }
                            break;
                        }

                        case (in_array($mercredi['wednesday_morning_open'], $closed_array) && in_array($mercredi['wednesday_afternoon_open'], $closed_array)):{
                            switch (false) {
                                case (in_array($jeudi['thursday_morning_open'], $closed_array)):
                                    echo 'et du Jeudi';
                                    break;

                                case (in_array($jeudi['thursday_afternoon_open'], $closed_array)):
                                    echo 'et du Jeudi';
                                    break;  

                                case (in_array($vendredi['friday_morning_open'], $closed_array)):
                                    echo 'et du Vendredi';
                                    break;
                                
                                case (in_array($vendredi['friday_afternoon_open'], $closed_array)):
                                    echo 'et du Vendredi';
                                    break;   

                                case (in_array($samedi['saturday_morning_open'], $closed_array)):
                                    echo 'et du Samedi';
                                    break;

                                case (in_array($samedi['saturday_afternoon_open'], $closed_array)):
                                    echo 'et du Samedi';
                                    break;
                    
                                default:
                                    echo 'et le Dimanche,';
                                    $only_one_day = true;
                                    break;
                            }
                            if(!$only_one_day){
                                switch (true) {
                                    case (in_array($samedi['saturday_morning_open'], $closed_array) && in_array($samedi['saturday_afternoon_open'], $closed_array)):
                                        echo ' au Vendredi,';
                                        break;

                                    case (in_array($dimanche['sunday_morning_open'], $closed_array) && in_array($dimanche['sunday_afternoon_open'], $closed_array)):
                                        echo ' au Samedi,';
                                        break;

                                    default:
                                        echo ' au Dimanche,';
                                        break;
                                }                                
                            }
                            break;
                        }
    
                        case (in_array($jeudi['thursday_morning_open'], $closed_array) && in_array($jeudi['thursday_afternoon_open'], $closed_array)):{
                            switch (false) {
                                case (in_array($vendredi['friday_morning_open'], $closed_array)):
                                    echo 'et du Vendredi';
                                    break;

                                case (in_array($vendredi['friday_afternoon_open'], $closed_array)):
                                    echo 'et du Vendredi';
                                    break;  

                                case (in_array($samedi['saturday_morning_open'], $closed_array)):
                                    echo 'et du Samedi';
                                    break;
                
                                case (in_array($samedi['saturday_afternoon_open'], $closed_array)):
                                    echo 'et du Samedi';
                                    break;
                    
                                default:
                                    echo 'et le Dimanche,';
                                    $only_one_day = true;
                                    break;
                            }
                            if(!$only_one_day){
                                switch (true) {
                                    case (in_array($dimanche['sunday_morning_open'], $closed_array) && in_array($dimanche['sunday_afternoon_open'], $closed_array)):
                                        echo ' au Samedi,';
                                        break;
                        
                                    default:
                                        echo ' au Dimanche,';
                                        break;
                                }                                
                            }
                            break;
                        }
                        
                        case (in_array($vendredi['friday_morning_open'], $closed_array) && in_array($vendredi['friday_afternoon_open'], $closed_array)):{
                            switch (false) {
                                case (in_array($samedi['saturday_morning_open'], $closed_array)):
                                    echo 'et du Samedi';
                                    break;

                                case (in_array($samedi['saturday_afternoon_open'], $closed_array)):
                                    echo 'et du Samedi';
                                    break;
                    
                                default:
                                    echo 'et le Dimanche,';
                                    $only_one_day = true;
                                    break;
                            }
                            if(!$only_one_day){
                                echo ' au Dimanche,';                            
                            }
                            break;
                        }

                        default:
                            break;
                    }
                }
            }

        }
        
        ?>
    </h2>

</div>
<?php endif; ?>