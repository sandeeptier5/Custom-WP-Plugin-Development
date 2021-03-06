<?php

class WPFS_Members_Table extends WP_List_Table
{
    function __construct()
    {
        parent::__construct(array(
            'singular' => 'Member', //Singular label
            'plural' => 'Members', //plural label, also this well be one of the table css class
            'ajax' => false //We won't support Ajax for this table
        ));
    }

    /**
     * Add extra markup in the toolbars before or after the list
     * @param string $which, helps you decide if you add the markup after (bottom) or before (top) the list
     */
    function extra_tablenav($which)
    {
        if ($which == "top")
        {
            //The code that goes before the table is here
            echo '<div class="wrap">';
        }
        if ($which == "bottom")
        {
            //The code that goes after the table is there
            echo '</div>';
        }
    }

    /**
     * Define the columns that are going to be used in the table
     * @return array $columns, the array of columns to use with the table
     */
    function get_columns()
    {
        return $columns = array(
            'memberID' => __('Member ID', 'wp-full-stripe-members'),
            'email' => __('Email', 'wp-full-stripe-members'),
            'role' => __('Role', 'wp-full-stripe-members'),
            'plan' => __('Plan ID', 'wp-full-stripe-members'),
            'stripeCustomerID' => __('Stripe Customer ID', 'wp-full-stripe-members'),
            'created' => __('Joined', 'wp-full-stripe-members'),
            'actions' => __('Actions', 'wp-full-stripe-members')
        );
    }

    /**
     * Decide which columns to activate the sorting functionality on
     * @return array $sortable, the array of columns that can be sorted by the user
     */
    public function get_sortable_columns()
    {
        return $sortable = array(
            'role' => array('role', false),
            'plan' => array('plan', false),
            'created' => array('created', false)
        );
    }

    /**
     * Prepare the table with different parameters, pagination, columns and table elements
     */
    function prepare_items()
    {
        global $wpdb;
        $screen = get_current_screen();

        // Preparing your query
        $query = "SELECT * FROM " . $wpdb->prefix . 'fullstripe_members';

        //Parameters that are going to be used to order the result
        $orderby = !empty($_REQUEST["orderby"]) ? esc_sql($_REQUEST["orderby"]) : 'ASC';
        $order = !empty($_REQUEST["order"]) ? esc_sql($_REQUEST["order"]) : '';
        if (!empty($orderby) && !empty($order))
        {
            $query .= ' ORDER BY ' . $orderby . ' ' . $order;
        }

        //Number of elements in your table?
        $totalitems = $wpdb->query($query); //return the total number of affected rows
        //How many to display per page?
        $perpage = 10;
        //Which page is this?
        $paged = !empty($_GET["paged"]) ? esc_sql($_GET["paged"]) : '';
        //Page Number
        if (empty($paged) || !is_numeric($paged) || $paged <= 0)
        {
            $paged = 1;
        }
        //How many pages do we have in total?
        $totalpages = ceil($totalitems / $perpage);
        //adjust the query to take pagination into account
        if (!empty($paged) && !empty($perpage))
        {
            $offset = ($paged - 1) * $perpage;
            $query .= ' LIMIT ' . (int)$offset . ',' . (int)$perpage;
        }

        // Register the pagination
        $this->set_pagination_args(array(
            "total_items" => $totalitems,
            "total_pages" => $totalpages,
            "per_page" => $perpage,
        ));
        //The pagination links are automatically built according to those parameters

        //Register the Columns
        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = array($columns, $hidden, $sortable);

        // Fetch the items
        $this->items = $wpdb->get_results($query);
    }

    /**
     * Display the rows of records in the table
     * @return string, echo the markup of the rows
     */
    function display_rows()
    {
        global $wp_roles;
        $role_names = $wp_roles->get_names();
        //Get the records registered in the prepare_items method
        $records = $this->items;

        //Get the columns registered in the get_columns and get_sortable_columns methods
        list($columns, $hidden) = $this->get_column_info();

        //Loop for each record
        if (!empty($records))
        {
            foreach ($records as $rec)
            {
                //Open the line
                echo '<tr id="record_' . $rec->memberID . '">';
                foreach ($columns as $column_name => $column_display_name)
                {
                    //Style attributes for each col
                    $class = "class='$column_name column-$column_name'";
                    $style = "";
                    if (in_array($column_name, $hidden)) $style = ' style="display:none;"';
                    $attributes = $class . $style;

                    //Display the cell
                    switch ($column_name)
                    {
                        case "memberID":
                            echo '<td ' . $attributes . '>' . stripslashes($rec->memberID) . '</td>';
                            break;
                        case "email":
                            echo '<td ' . $attributes . '>' . $rec->email  . '</td>';
                            break;
                        case "role":
                            echo '<td ' . $attributes . '>' . $role_names[$rec->role] . '</td>';
                            break;
                        case "plan":
                            echo '<td ' . $attributes . '>' . $rec->plan . '</td>';
                            break;
                        case "stripeCustomerID":
                            $stripeLink = "<a href='https://dashboard.stripe.com/";
                            if ($rec->livemode == 0) $stripeLink .= 'test/';
                            $stripeLink .= "customers/" . $rec->stripeCustomerID . "'>$rec->stripeCustomerID</a>";
                            echo '<td ' . $attributes . '>' . $stripeLink . '</td>';
                            break;
                        case "created":
                            echo '<td ' . $attributes . '>' . date('F jS Y H:i', strtotime($rec->created))  . '</td>';
                            break;
                        case "actions":
                            echo '<td ' . $attributes . '>' .
                                '<a class="button" href="' . admin_url("admin.php?page=wpfs-members-edit&member=") . $rec->memberID . '">Edit</a>' . '</td>';
                            break;
                    }
                }

                //Close the line
                echo'</tr>';
            }
        }
    }
}
