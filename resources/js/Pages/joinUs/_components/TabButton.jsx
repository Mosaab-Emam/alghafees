import ArrowDownIcon from "../../ArrowDownIcon";

const TabButton = ({
    onActiveHandler,
    activeTab,
    children,
    index,
    className = "xl:w-[630px] lg-w-full w-full",
}) => {
    return (
        <div className="relative xl:w-[630px] lg:w-full w-[312px] xl:h-[76px] lg:h-[60px] h-[63.927px] py-[9px] flex items-start md:justify-between md:gap-0 gap-2 flex-grow">
            <button
                onClick={onActiveHandler}
                className={`${
                    activeTab === index
                        ? "bg-primary-600 text-bg-01 "
                        : "text-primary-600"
                } head-line-h4 ${className} sm:h-[48px] lg:h-[46px] xl:h-[48px] text-center border border-primary-600 transition duration-500 ease-in-out reports-box-shadow md:rounded-none rounded-md`}
            >
                {children}
            </button>
            {activeTab === index && (
                <div className="absolute bottom-[-1rem] xl:right-[276px] lg:right-[236px] right-[40%] transition duration-500 ease-in-out z-10">
                    <ArrowDownIcon />
                </div>
            )}
        </div>
    );
};

export default TabButton;
