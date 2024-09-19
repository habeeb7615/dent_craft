 <tr class="damage_row" id="damage_row{{ $damagedArea['id'] }}">
    <td>{{ $damagedArea['panel_area_name'] }}</td>
    <td>
        <input type="hidden" name="damaged_areas[{{ $damagedArea['id'] }}][0][panel_area_name]" value="{{ $damagedArea['panel_area_name'] }}">
        <input type="hidden" name="damaged_areas[{{ $damagedArea['id'] }}][0][position]" value="{{ $damagedArea['position'] }}">
        <input type="text" list="priceslist" name="damaged_areas[{{ $damagedArea['id'] }}][0][price]" value="0" id="damage_price{{ $damagedArea['id'] }}" class="form-control"/>
        <datalist id="priceslist">
            <option>0</option>
            <option>100</option>
            <option>150</option>
            <option>250</option>
            <option>350</option>
            <option>550</option>
            <option>750</option>
            <option>950</option>
            <option>1200</option>
            <option>1650</option>
            <option>2000</option>
        </datalist>
    </td>
    <td colspan="2">
        <input type="hidden" name="damaged_areas[{{ $damagedArea['id'] }}][0][guard_id]" value="1">
        <select class="form-control" id="damage_select{{ $damagedArea['id'] }}">
            <option value="1" selected locked="locked">+</option>
            <option value="2">Extreme Size</option>
            <option value="3">Aluminium</option>
            <option value="4">Panel Crease</option>
            <option value="5">P2P</option>
        </select>
        @push("scripts")
        <script>
            function add_damage_element(n,a,b,c){

                $('#damage_select'+a).append("<option value="+c+">"+b+"</option>");

                $("#damage_row"+a+"_"+c).remove();
            }

            $("#damage_select{{ $damagedArea['id'] }}").change(function(e){
                var damage_row = $("#damage_row{{ $damagedArea['id'] }}")
                var price_list = damage_row.find("td > input[list='priceslist']")

                var n = parseInt($(".table-responsive>table>tbody>tr").length)-1;
                var td1 = damage_row.find("td:nth-child(1)").html();
                var td2 = price_list.val();
                var td3 = $(this).val();
                var option_text = damage_row.find("option[value='"+td3+"']").text();

                price_list.val('0')

                if(!/^\d+$/.test(td2) || td2 == 0){
                    price_list.focus();
                    price_list.select();
                    $(this).val(1)
                    return ;
                }

                var total_damage_count = parseInt({{ $damagedAreasCount }}) - 1;

                var number_of_damages = n - total_damage_count;

                n = n + 1;

                var arg = [n,"{{ $damagedArea['id'] }}","'"+option_text+"'",td3];

                var button = '<button class="btn btn-primary icon-btn" type="button" onclick="add_damage_element('+arg+');">Remove</button>';

                var row = '<tr id="damage_row{{ $damagedArea['id'] }}_'+td3+'"><td>'+td1+'</td><td><input type="hidden" name=damaged_areas[{{ $damagedArea['id'] }}]['+number_of_damages+'][guard_id]" value="'+td3+'">'+td2+'</td><td><input type="hidden" name="damaged_areas[{{ $damagedArea['id'] }}]['+number_of_damages+'][price]" value="'+td2+'">'+option_text+'</td><td>'+button+'</td></tr>';

                damage_row.after(row);

                damage_row.find("option[value='"+td3+"']").each(function() {
                    $(this).remove();
                });
            });

        </script>
        @endpush
    </td>
</tr>





{{-- <tr class="damage_row" id="damage_row{{ $damagedArea->id }}">
    <td>{{ $damagedArea->panel_area_name }}</td>
    <td>
        <input type="text" list="priceslist" name="damaged_areas[{{ $damagedArea->id }}][0][price]" value="0" id="damage_price{{ $damagedArea->id }}" class="form-control"/>
        <datalist id="priceslist">
            <option>0</option>
            <option>100</option>
            <option>150</option>
            <option>250</option>
            <option>350</option>
            <option>550</option>
            <option>750</option>
            <option>950</option>
            <option>1200</option>
            <option>1650</option>
            <option>2000</option>
        </datalist>
    </td>
    <td colspan="2">
        <input type="hidden" name="damaged_areas[{{ $damagedArea->id }}][0][guard_id]" value="1">
        <select class="form-control" id="damage_select{{ $damagedArea->id }}">
            <option value="1" selected locked="locked">+</option>
            <option value="2">Extreme Size</option>
            <option value="3">Aluminium</option>
            <option value="4">Panel Crease</option>
            <option value="5">P2P</option>
        </select>
        @push("scripts")
        <script>
            function add_damage_element(n,a,b,c){

                $('#damage_select'+a).append("<option value="+c+">"+b+"</option>");

                $("#damage_row"+a+"_"+c).remove();
            }

            $("#damage_select{{ $damagedArea->id }}").change(function(e){
                var damage_row = $("#damage_row{{ $damagedArea->id }}")
                var price_list = damage_row.find("td > input[list='priceslist']")

                var n = parseInt($(".table-responsive>table>tbody>tr").length)-1;
                var td1 = damage_row.find("td:nth-child(1)").html();
                var td2 = price_list.val();
                var td3 = $(this).val();
                var option_text = damage_row.find("option[value='"+td3+"']").text();

                price_list.val('0')

                if(!/^\d+$/.test(td2) || td2 == 0){
                    price_list.focus();
                    price_list.select();
                    $(this).val(1)
                    return ;
                }

                var total_damage_count = parseInt({{ $damagedAreasCount }}) - 1;

                var number_of_damages = n - total_damage_count;

                n = n + 1;

                var arg = [n,"{{ $damagedArea->id }}","'"+option_text+"'",td3];

                var button = '<button class="btn btn-primary icon-btn" type="button" onclick="add_damage_element('+arg+');">Remove</button>';

                var row = '<tr id="damage_row{{ $damagedArea->id }}_'+td3+'"><td>'+td1+'</td><td><input type="hidden" name=damaged_areas[{{ $damagedArea->id }}]['+number_of_damages+'][guard_id]" value="'+td3+'">'+td2+'</td><td><input type="hidden" name="damaged_areas[{{ $damagedArea->id }}]['+number_of_damages+'][price]" value="'+td2+'">'+option_text+'</td><td>'+button+'</td></tr>';

                damage_row.after(row);

                damage_row.find("option[value='"+td3+"']").each(function() {
                    $(this).remove();
                });
            });

        </script>
        @endpush
    </td>
</tr> --}}

