function addOptions(the_options, the_sel)
{
	len = the_options.length;
	while (the_sel.hasChildNodes())
	{
		the_sel.removeChild(the_sel.firstChild);
	}
	for (i=0; i<len; i++)
	{
		op = document.createElement("option");
		the_val = the_options[i];
		val = document.createAttribute('value');
		val.value = the_val; 
		op.setAttributeNode(val);
		the_text = document.createTextNode(the_val);
		op.appendChild(the_text);
		if (i==0)
		{
			op.selected=true;
		}
		the_sel.appendChild(op);
	}
}
function fillEm(no)
{
	for (j=no; j<boxes_len; j++)
	{
		if (j==0)
		{
			the_options = our_array[0][1];
			addOptions(the_options, boxes[j]);
		}
		else
		{
			pVal = boxes[j-1].value;
			for (k = 0; k<arr_len; k++)
			{
				if (our_array[k][0] == pVal)
				{
					text_overview=document.getElementById("overview");
					text_objective=document.getElementById("example_objective");
					if(our_array[k].length==4)
					{
						text_overview.value=our_array[k][2];
						text_objective.value=our_array[k][3];
					}
					the_options = our_array[k][1];
					addOptions(the_options, boxes[j]);
				}
			}
		}
	}
} 
window.onload = function window_loads()
{
	boxes = document.getElementById('goals_form').getElementsByTagName('select');
	boxes_len = boxes.length; 
	our_array = goals;
	arr_len = our_array.length;
	textGl=document.getElementById("create_goals_goal_list");
	fillEm(0);
	for (i=0; i<boxes_len; i++)
	{
		boxes[i].onchange=function()
		{
			var check=0;
			for (m=0; m<boxes_len; m++)
			{
				if (this==boxes[m])
				{
					fillEm(m+1);
					check=check+1;
					if(m==1)
					{	
						if(check==1)
						{
							textVb=document.getElementById("verb");
							textGl=document.getElementById("create_goals_goal_list");
							textGl.value=textGl.value + "\n" + " * " + textVb.value + " ";
						}
					}
				}
			}
		}
	}	
}