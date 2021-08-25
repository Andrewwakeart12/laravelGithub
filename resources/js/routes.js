const routes = {
    "generated::BHTyyk3BRW3DNqu7": {
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
    "options": {
        "uri": "api\/options"
    },
    "generated::nW2qTLnQTkLcAmnh": {
        "uri": "\/"
    },
    "generated::YkPHZhYjBc25oAIq": {
        "uri": "mucks"
    },
    "adminPage": {
        "uri": "admin"
    },
    "login": {
        "uri": "login"
    },
    "generated::nvRKnHcipii9xHJD": {
        "uri": "login"
    },
    "logout": {
        "uri": "logout"
    },
    "register": {
        "uri": "register"
    },
    "generated::TywFaVLwgMDT7Lcj": {
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
    "generated::izztR1RYldOFIr4B": {
        "uri": "password\/confirm"
    },
    "home": {
        "uri": "home"
    },
    "getApiKey": {
        "uri": "getApiKey"
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
