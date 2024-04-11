const fn = {
    getShortUrl: (base, code, user) => {
        if (user.use_prefix === 1) {
            return `${base}/${user.username}/${code}`;
        }
        return `${base}/${code}`;
    },
    countVisitors: (data) => {
        const uniqueIps = new Set();
        let visitorCount = 0;

        for (const item of data) {
            for (const stat of item.statistics) {
                uniqueIps.add(stat.ip_address);
                visitorCount++;
            }
        }

        return { total: visitorCount, unique: uniqueIps.size };
    },
    getCounterText: (number, text, withNumber = true) => {
        if (withNumber) {
            return (number > 1) ? `${number} ${text}s` : `${number} ${text}`;
        }
        return (number > 1) ? `${text}s` : `${text}`;
    }
}

export default fn;