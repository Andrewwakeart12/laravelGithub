const routes = {
    "generated::qgUlwrePbdDVvR3d": {
        "uri": "broadcasting\/auth"
    },
    "generated::FgVdygLbaecr9tXO": {
        "uri": "api\/user"
    },
    "Posts.index": {
        "uri": "api\/Posts"
    },
    "Posts.create": {
        "uri": "api\/Posts\/create"
    },
    "Posts.store": {
        "uri": "api\/Posts"
    },
    "Posts.show": {
        "uri": "api\/Posts\/{Post}"
    },
    "Posts.edit": {
        "uri": "api\/Posts\/{Post}\/edit"
    },
    "Posts.update": {
        "uri": "api\/Posts\/{Post}"
    },
    "Posts.destroy": {
        "uri": "api\/Posts\/{Post}"
    },
    "users.index": {
        "uri": "api\/users"
    },
    "users.create": {
        "uri": "api\/users\/create"
    },
    "users.store": {
        "uri": "api\/users"
    },
    "users.show": {
        "uri": "api\/users\/{user}"
    },
    "users.edit": {
        "uri": "api\/users\/{user}\/edit"
    },
    "users.update": {
        "uri": "api\/users\/{user}"
    },
    "users.destroy": {
        "uri": "api\/users\/{user}"
    },
    "getRoles": {
        "uri": "api\/getRoles"
    },
    "getUsers": {
        "uri": "api\/getUsers"
    },
    "getChatNotifications": {
        "uri": "api\/getNotifications"
    },
    "getNotifications": {
        "uri": "api\/getChatNotifications"
    },
    "readNotifications": {
        "uri": "api\/readNotifications\/{notifications}"
    },
    "getLastNotification": {
        "uri": "api\/getLastNotification"
    },
    "thisUserId": {
        "uri": "api\/getThisUserId"
    },
    "getUsersChats": {
        "uri": "api\/getUsersChats"
    },
    "preselectedSecondUser": {
        "uri": "api\/preselectedSecondUser"
    },
    "getMessagesInChat": {
        "uri": "api\/getMessagesInChat"
    },
    "sendMessage": {
        "uri": "api\/sendMessage"
    },
    "getChannels": {
        "uri": "api\/getChannels"
    },
    "roles.index": {
        "uri": "api\/roles"
    },
    "roles.create": {
        "uri": "api\/roles\/create"
    },
    "roles.store": {
        "uri": "api\/roles"
    },
    "roles.show": {
        "uri": "api\/roles\/{role}"
    },
    "roles.edit": {
        "uri": "api\/roles\/{role}\/edit"
    },
    "roles.update": {
        "uri": "api\/roles\/{role}"
    },
    "roles.destroy": {
        "uri": "api\/roles\/{role}"
    },
    "task.index": {
        "uri": "api\/task"
    },
    "task.create": {
        "uri": "api\/task\/create"
    },
    "task.store": {
        "uri": "api\/task"
    },
    "task.show": {
        "uri": "api\/task\/{task}"
    },
    "task.edit": {
        "uri": "api\/task\/{task}\/edit"
    },
    "task.update": {
        "uri": "api\/task\/{task}"
    },
    "task.destroy": {
        "uri": "api\/task\/{task}"
    },
    "events": {
        "uri": "api\/eventos"
    },
    "generated::g9YNN9mNHZ2U5FB6": {
        "uri": "\/"
    },
    "generated::vXI4IzQ5258CZ9UZ": {
        "uri": "mucks"
    },
    "adminPage": {
        "uri": "admin"
    },
    "generated::1L2IoFrmylVu2IPa": {
        "uri": "admin\/{any}"
    },
    "login": {
        "uri": "login"
    },
    "generated::5HzbwzGQsL7JGevo": {
        "uri": "login"
    },
    "logout": {
        "uri": "logout"
    },
    "register": {
        "uri": "register"
    },
    "generated::zzjIv7CKAJ5PXtVm": {
        "uri": "register"
    },
    "password.request": {
        "uri": "password\/reset"
    },
    "password.email": {
        "uri": "password\/email"
    },
    "password.reset": {
        "uri": "password\/reset\/{token}"
    },
    "password.update": {
        "uri": "password\/reset"
    },
    "password.confirm": {
        "uri": "password\/confirm"
    },
    "generated::P8AjIOCAIdhgzkRA": {
        "uri": "password\/confirm"
    },
    "home": {
        "uri": "home"
    },
    "getApiKey": {
        "uri": "getApiKey"
    },
    "generated::0rI7C34Jk0BG0laX": {
        "uri": "test"
    }
};

const route = (routeName, params = [], absolute = true) => {
  const _route = routes[routeName];
  if (_route == null) throw "Requested route doesn't exist";

  let uri = _route.uri;

  const matches = uri.match(/{[\w]+\??}/g) || [];
  const optionals = uri.match(/{[\w]+\?}/g) || [];

  const requiredParametersCount = matches.length - optionals.length;

  if (params instanceof Array) {
    if (params.length < requiredParametersCount) throw "Missing parameters";

    for (let i = 0; i < requiredParametersCount; i++)
      uri = uri.replace(/{[\w]+\??}/, params.shift());

    for (let i = 0; i < params.length; i++)
      uri += (i ? "&" : "?") + params[i] + "=" + params[i];
  } else if (params instanceof Object) {
    let extraParams = matches.reduce((ac, match) => {
      let key = match.substring(1, match.length - 1);
      let isOptional = key.endsWith("?");
      if (params.hasOwnProperty(key.replace("?", ""))) {
        uri = uri.replace(new RegExp(match.replace("?", "\\?"), "g"), params[key.replace("?", "")]);
        delete ac[key.replace("?", "")];
      } else if (isOptional) {
          uri = uri.replace("/" + new RegExp(match, "g"), "");
      }
      return ac;
    }, params);

    Object.keys(extraParams).forEach((key, i) => {
      uri += (i ? "&" : "?") + key + "=" + extraParams[key];
    });
  }

  if (optionals.length > 0) {
    for (let i in optionals) {
      uri = uri.replace("/" + optionals[i], "");
    }
  }

  if (uri.includes("}")) throw "Missing parameters";

  if (absolute && process.env.MIX_APP_URL)
    return process.env.MIX_APP_URL + "/" + uri;
  return "/" + uri;
};

export { route };
