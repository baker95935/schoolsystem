#include  <opencv2/highgui/highgui.hpp>
#include  <opencv2/imgproc/imgproc.hpp>
#include  <iostream>
#include  <math.h>
#include  <ctime>
#include  <time.h>
#include  <string>
#include  <vector>
#include <iomanip>
#include <string>
#include <cstdio>

using namespace cv;
using namespace std;

int main(int argc, char** argv)
{
    if(argc!=3)
    {
        exit(0);
    }
    string  address = argv[1];
    Mat src = cv::imread(address);
    string  newaddress = argv[2];
    imwrite(newaddress, src);
    return 0;
}


