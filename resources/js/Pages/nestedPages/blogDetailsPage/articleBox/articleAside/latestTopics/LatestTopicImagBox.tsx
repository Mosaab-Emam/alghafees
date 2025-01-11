import BlogCard from "../../../../../blog/blogsBox/BlogCard";

export default function LatestTopicImagBox({
    className,
    latest_posts,
}: {
    className?: string;
    latest_posts: Array<any>;
}) {
    return (
        <div className={`${className}`}>
            {latest_posts.map((post) => (
                <BlogCard key={post.id} post={post} isLatestTopic={true} />
            ))}
        </div>
    );
}
