<?php

return [
  /*task*/
  'status' => [
    'new' => 1,
    'started' => 2,
    'cancelled' => 3,
    'pending' => 4,
    'completed' => 5,
    'rejected' => 6,
    'approved' => 7,
  ],
  'priority' => [
    'low' => 1,
    'medium' => 2,
    'high' => 3,
  ],
  'userLevel' => [
    'admin' => 1,
    'moderator' => 0,
  ],
  /*end of task*/

  /*navbar2*/
  'navbar2' => [
    'home' => [
      'title' => 'Home',
      'child' => [
        [
          'title' => 'Projects',
          'url' => '/home/projects'
        ]
      ],
    ],
    'tasks' => [
      'title' => 'Task',
    ],
    'notifications' => [
      'title' => 'Notification',
    ],
    'timelines' => [
      'title' => 'Timeline',
    ],
    'settings' => [
      'title' => 'Setting'
    ],
    'admins' => [
      'title' => 'Admin',
      'child' => [
        [
          'title' => 'Tasks',
          'url' => '/admins/tasks'
        ],
        [
          'title' => 'Create Task',
          'url' => '/admins/tasks/create'
        ],
        [
          'title' => 'Project Setting',
          'url' => '/admins/project'
        ]
      ],
    ]
  ],
  /*end of navbar2*/
];