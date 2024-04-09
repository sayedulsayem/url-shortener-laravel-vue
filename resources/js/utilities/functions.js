const fn = {
    getShortUrl: (base, code, user) => {
        if(user.use_prefix === 1) {
            return `${base}/${user.username}/${code}`;
        }
        return `${base}/${code}`;
    }
}

export default fn;