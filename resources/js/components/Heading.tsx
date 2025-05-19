const Heading = ({
    title,
    size,
    className = "",
}: {
    title: string;
    size: 1 | 2 | 3 | 4 | 5 | 6;
    className?: string;
}) => {
    let Tag;
    switch (size) {
        case 1:
            Tag = (
                <h1 className={`head-line-h1 text-Black-01 ${className}`}>
                    {title}
                </h1>
            );
            break;
        case 2:
            Tag = (
                <h2 className={`head-line-h2 text-Black-01 ${className}`}>
                    {title}
                </h2>
            );
            break;
        case 3:
            Tag = (
                <h3 className={`head-line-h3 text-Black-01 ${className}`}>
                    {title}
                </h3>
            );
            break;
        case 4:
            Tag = (
                <h4 className={`head-line-h4 text-Black-01 ${className}`}>
                    {title}
                </h4>
            );
            break;
        case 5:
            Tag = (
                <h5 className={`head-line-h5 text-Black-01 ${className}`}>
                    {title}
                </h5>
            );
            break;
        case 6:
            Tag = (
                <h6 className={`head-line-h6 text-Black-01 ${className}`}>
                    {title}
                </h6>
            );
            break;
        default:
            <></>;
            break;
    }

    return Tag;
};

export default Heading;
