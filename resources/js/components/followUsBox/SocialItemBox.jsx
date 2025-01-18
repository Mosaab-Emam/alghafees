const SocialItemBox = ({ children, url }) => {
    return (
        <a
            target="_blank"
            href={url}
            className="w-[32px] h-[32px] flex-shrink-0 bg-bg-02 flex justify-center items-center  drop-shadow-[0px_8px_16px_rgba(23,133,162,0.07)] cursor-pointer hover:bg-primary-100 hover:drop-shadow-[0px_20px_40px_rgba(23,133,162,0.10)] transition duration-700 ease-in-out"
        >
            {children}
        </a>
    );
};

export default SocialItemBox;
